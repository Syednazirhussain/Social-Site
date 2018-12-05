<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Log;

use Auth;
use Flash;
use Session;

use App\User;
use App\Models\Admin\AdditionalInfo;
use App\Models\Admin\Post;
use App\Models\Admin\PostCategory;
use App\Models\Admin\PostMeta;
use App\Models\Admin\Follow;
use App\Models\Admin\Subscription;
use App\Models\Admin\SubscriptionOrder;
use App\Models\Admin\MemberShipPlan;

use Mail;

class FanController extends Controller
{

    private $provider; 

    function __construct(ExpressCheckout $express)
    {
        $this->provider = $express;
        $this->middleware('fan.route')->except('subcription_details');
    }

    public function subcription_plan()
    {
        $user_id = Auth::user()->id;
        $memberShipPlan = MemberShipPlan::where('code','premium')->first();

        $amount = $memberShipPlan->price;
        $planCode = $memberShipPlan->code;

        $data = [
            'user_id'           => $user_id,
            'planCode'          => $planCode,
            'amount'            => $amount
        ];

        return view('local.fan.subcription.index',$data);
    }

    public function subcription_request(Request $request)
    {
        $input = $request->except(['_token']);
        
        $user_id = $input['user_id'];
        $planCode = $input['planCode'];

        $membership_id = MemberShipPlan::where('code',$input['planCode'])->first()->id;

        $renewal_date = date('Y-m-d');
        $date = strtotime(date('Y-m-d', strtotime($renewal_date)) . "+1 months");
        $renewed_date = date('Y-m-d',$date);


        $subcription = Subscription::firstOrCreate([
            'code'          => $input['planCode'],
            'user_id'       => $user_id,
            'membership_id' => $membership_id,
            'status'        => 'active',
            'renewal_date'  => $renewal_date,
            'renewed_date'  => $renewed_date
        ]);

        if(!empty($subcription))
        {
            $amount = MemberShipPlan::where('code',$planCode)->first()->price;
            $status = 'pending';

            $subscriptionOrder = new SubscriptionOrder;
            $subscriptionOrder->user_id = $user_id;
            $subscriptionOrder->subscription_plan_id = $subcription->id;
            $subscriptionOrder->amount = $amount;
            $subscriptionOrder->status = $status;
            if($subscriptionOrder->save())
            {
                $data = [];
                $data['items'] = [
                    [
                        'name' => 'Creatify premium offer',
                        'price' => $amount,
                        'qty' => 1
                    ]
                ];
                
                $data['invoice_id'] = $subscriptionOrder->id;
                $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
                $data['return_url'] = route('fan.subcription.response');
                $data['cancel_url'] = route('fan.subcription.plan');
                $data['total'] = $amount;
                $data['shipping_discount'] = round((10 / 100) * $amount, 2);

                $response = $this->provider->setExpressCheckout($data);
                return redirect($response['paypal_link']);
            }
            else
            {
                Session::flash('errorMsg','Subcription order were not created');
                return redirect()->route('fan.subcription.plan');
            }
        }
        else
        {
            Session::flash('errorMsg','User subcription were not found');
            return redirect()->route('fan.subcription.plan');
        }

        // $subscription_id = $input['subscription_id'];
        // $subcription = Subscription::find($subscription_id);
        // $amount = $subcription->membership->price;
        // $subscriptionOrder = SubscriptionOrder::where('user_id',$input['user_id'])->first();
    }

    public function subcription_response(Request $request)
    {
        if($request->has('token') && $request->has('PayerID'))
        {
            $token = $request->input('token');
            $payerID = $request->input('PayerID');

            $response = $this->provider->getExpressCheckoutDetails($token);

            if(isset($response['PAYMENTREQUEST_0_INVNUM']))
            {
                $subcription_order_id = $response['PAYMENTREQUEST_0_INVNUM'];
                $subscriptionOrder = SubscriptionOrder::findOrFail($subcription_order_id);
                if(!empty($subscriptionOrder))
                {
                    $subcription_id = $subscriptionOrder->subscription_plan_id;
                    $user_id = $subscriptionOrder->user_id;

                    $subscriptionOrder->transaction_id = $token;
                    $subscriptionOrder->status = 'paid';
                    if($subscriptionOrder->save())
                    {
                        if(Auth::user()->id = $user_id)
                        {
                            $memberShip_id = MemberShipPlan::where('code','premium')->first()->id;
                            
                            if(Subscription::find($subcription_id)->update(['membership_id' => $memberShip_id,'code' => 'premium']))
                            {
                                User::find($user_id)->update(['plan_code' => 'premium']);

                                $user = Auth::user();
                                $user->syncRoles(['Talents']);

                                // send Thank you email
                                $data = [
                                    'name'  => $user->name,
                                    'email' => $user->email
                                ];
                                Mail::send('email.subcription',$data,function($message) use($data){
                                    $message->to($data['email'])->subject('Become a talent');
                                });
                                Session::flash('successMsg','Thank for you to subcribe our platfrom');
                                return redirect()->route('talent.user.dashboard');
                            }
                            else
                            {
                                Session::flash('errorMsg','Subcription plan were not updated');
                                return redirect()->route('fan.subcription.plan');
                            }
                        }
                        else
                        {
                            Session::flash('errorMsg','User identity invalid');
                            return redirect()->route('fan.subcription.plan');
                        }
                    }
                    else
                    {
                        Session::flash('errorMsg','Subcription Order not found');
                        return redirect()->route('fan.subcription.plan');
                    }
                }
                else
                {
                    Session::flash('errorMsg','Payment were not successful');
                    return redirect()->route('fan.subcription.plan');
                }
            }
            else
            {
                Session::flash('errorMsg','OrderID not found');
                return redirect()->route('fan.subcription.plan');
            }
        }
        else
        {
            Session::flash('errorMsg','Payment were not successful');
            return redirect()->route('fan.subcription.plan');
        }
    }

    public function subcription_message()
    {
        return view('local.fan.subcription.message');
    }

    public function subcription_details(Request $request)
    {

        //Log::info('Inside details: ',['message' => 'Hello']);
        //$request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();        
        
        //$response = (string) $this->provider->verifyIPN($post);

        Log::info('This is test', $post);


        // Log::info('Data: ',$request->all());

        // return $request->all();

        
        // if ($response === 'VERIFIED') 
        // {

        // }

        // $input = $request->all();
        // $token = $input['token'];
        // $payerID = $input['PayerID'];

        // $response = $this->provider->getExpressCheckoutDetails($token);
        // echo "<pre>";
        // print_r($response);
        // exit;
    }

    public function dashboard()
    {
        $users = User::all();
        $follows = Follow::all();

        $followers = [];


        foreach ($users as $user) 
        {
            if(Auth::user()->id != $user->id)
            {
                foreach ($follows as $follow) 
                {
                    if($follow->follower_id == Auth::user()->id)
                    {
                        if(!in_array($follow->followed_id, $followers))
                        {
                            array_push($followers, $follow->followed_id);
                        }
                    }
                }
            }
        }
   
        $user = Auth::user();
        $additional_info = AdditionalInfo::where('user_id',$user->id)->first();


        $data = [
            'user'              => $user,
            'additional_info'   => $additional_info,
            'users'             => $users,
            'follows'           => $followers
        ];

        return view('local.fan.dashboard.index',$data);
    }

    public function preview_talent_profile($talent_id)
    {
        $users = User::all();
        $follows = Follow::all();

        $followers = [];

        foreach ($users as  $user) 
        {
            foreach ($follows as $follow) 
            {
                if($follow->followed_id == $talent_id)
                {
                    if(!in_array($follow->follower_id, $followers))
                    {
                        array_push($followers, $follow->follower_id);
                    }
                }
            }
        }

        $user = User::find($talent_id);


        $data = [
            'user'      => $user,
            'users'     => $users,
            'follows'   => $followers
        ];


        return view('local.fan.dashboard.preview_talent',$data);
    }

    public function preview_talent_detail($talent_id)
    {
        $postMetas = PostMeta::all();

        $vedios = [];
        $images = [];

        foreach ($postMetas as $meta) 
        {
            $meta_clusters = explode("_", $meta->meta_key);
            if($talent_id == $meta_clusters[0])
            {
                $type  = $meta_clusters[count($meta_clusters)-1];

                $user_name = '';
                $post_id = 0;
                $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
                foreach ($meta->posts as  $post) 
                {
                    if($post->user->id == $meta_clusters[0])
                    {
                        $user_name = $post->user->name;
                        $post_id = $post->id;
                        break;
                    }
                }            

                if($type == 'vedio')
                {
                    $vedio_info = json_decode($meta->meta_value,true);
                    if($vedio_info['vedio_type'] == 'youtube')
                    {
                        $url = $vedio_info['vedio_url'];
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                        {
                            $video_id = $match[1];
                        }
                        $thumbnail_url = "https://img.youtube.com/vi/".$video_id."/sddefault.jpg";
                        $vedio_info['vedio_url'] = "https://www.youtube.com/embed/".$video_id;
                        $vedio_info['image_url'] = $thumbnail_url;

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;


                    }
                    elseif($vedio_info['vedio_type'] == 'dailymotion')
                    {
                        $original_url = $vedio_info['vedio_url'];
                        $lastSegment = basename(parse_url($original_url, PHP_URL_PATH));
                        $url = explode("_", $lastSegment);
                        $thumbnail_url = "http://www.dailymotion.com/thumbnail/video/".$url[0];
                        $vedio_info['vedio_url'] = "https://www.dailymotion.com/embed/video/".$url[0];
                        $vedio_info['image_url'] = $thumbnail_url;

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;
                    }
                    elseif($vedio_info['vedio_type'] == 'vimeo')
                    {
                        $vimeo = $vedio_info['vedio_url'];
                        $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                        $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                        $contents = @file_get_contents($url);
                        $array = @unserialize(trim($contents));
                        $vedio_info['vedio_url'] = "https://player.vimeo.com/video/".$vimeoGetID;
                        $vedio_info['image_url'] = $array[0]['thumbnail_large'];

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;
                    }
                }
                elseif($type == 'images')
                {
                    if(!is_null($meta->meta_value))
                    {
                        $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));

                        $image_post_key = $meta_clusters[1]."_".$post_id;
                        $image_post[$image_post_key] = ['images' => $images_info];

                        $image_key = $user_name."_".$meta_clusters[0];                    
                        $images[$image_key] = $image_post;

                    }
                }
            }
        }

        $videos_arr['videos'] = $vedios;
        $images_arr['images'] = $images;



        $additional_info = AdditionalInfo::where('user_id',$talent_id)->first()->toArray();    
        $postCategories = PostCategory::all()->toArray();


        $data = [
            'postCategories'    => $postCategories,
            'additional_info'   => $additional_info
        ];

        if(!empty($images_arr))
        {
            $data['images'] = $images_arr;
        }

        if(!empty($videos_arr))
        {
            $data['vedios'] = $videos_arr;
        }



        $posts = Post::where('post_type','text')
                        ->where('user_id',$talent_id)
                        ->orderBy('created_at', 'desc')->get();


        if(isset($posts))
        {
            if(!empty($posts))
            {
                $post_data = [];
                $index = 0;
                foreach ($posts as $post) 
                {
                    $post_data[$index] = [
                                            'id' => $post->id,
                                            'user_id' => $post->user_id,
                                            'user_name' => $post->user->name,
                                            'user_plan_code' => $post->user->plan_code,
                                            'post_category_id' => $post->post_category_id,
                                            'post_category_name' => $post->postCategory->name,
                                            'post_type' => $post->post_type,
                                            'title' => $post->title,
                                            'description' => utf8_encode($post->description),
                                            'image' => $post->image,
                                            'status' => $post->status,
                                            'created_at' => utf8_encode($post->created_at),
                                        ];
                    $index++;

                    $data['posts'] = $post_data;
                }
            }
        }

        return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }




    public function retrive_profile_info()
    {
        $users = User::all();
        $follows = Follow::all();

        $followers = [];

        foreach ($users as $user) 
        {
            if(Auth::user()->id != $user->id)
            {
                foreach ($follows as $follow) 
                {
                    if($follow->follower_id == Auth::user()->id)
                    {
                        if(!in_array($follow->followed_id, $followers))
                        {
                            array_push($followers, $follow->followed_id);
                        }
                    }
                }
            }
        }

        $postMetas = PostMeta::all();

        $vedios = [];
        $images = [];

        $different_user_images = [];
        $different_user_video = [];

        foreach ($postMetas as $meta) 
        {
            $meta_clusters = explode("_", $meta->meta_key);
            if( in_array($meta_clusters[0] , $followers) )
            {
                $type  = $meta_clusters[count($meta_clusters)-1];

                $user_name = '';
                $post_id = 0;
                $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
                foreach ($meta->posts as  $post) 
                {
                    if($post->user->id == $meta_clusters[0])
                    {
                        $user_name = $post->user->name;
                        $post_id = $post->id;
                        break;
                    }
                }            

                if($type == 'vedio')
                {

                    $vedio_info = json_decode($meta->meta_value,true);
                    if($vedio_info['vedio_type'] == 'youtube')
                    {
                        $url = $vedio_info['vedio_url'];
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                        {
                            $video_id = $match[1];
                        }
                        $thumbnail_url = "https://img.youtube.com/vi/".$video_id."/sddefault.jpg";
                        $vedio_info['vedio_url'] = "https://www.youtube.com/embed/".$video_id;
                        $vedio_info['image_url'] = $thumbnail_url;

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_key = $user_name."_".$meta_clusters[0];   

                        //$video_post[$video_post_key] = ['videos' => $vedio_info];
                        //$vedios[$video_key] = $video_post;


                    }
                    elseif($vedio_info['vedio_type'] == 'dailymotion')
                    {
                        $original_url = $vedio_info['vedio_url'];
                        $lastSegment = basename(parse_url($original_url, PHP_URL_PATH));
                        $url = explode("_", $lastSegment);
                        $thumbnail_url = "http://www.dailymotion.com/thumbnail/video/".$url[0];
                        $vedio_info['vedio_url'] = "https://www.dailymotion.com/embed/video/".$url[0];
                        $vedio_info['image_url'] = $thumbnail_url;

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_key = $user_name."_".$meta_clusters[0];   

                        //$video_post[$video_post_key] = ['videos' => $vedio_info];
                        //$vedios[$video_key] = $video_post;
                    }
                    elseif($vedio_info['vedio_type'] == 'vimeo')
                    {
                        $vimeo = $vedio_info['vedio_url'];
                        $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                        $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                        $contents = @file_get_contents($url);
                        $array = @unserialize(trim($contents));
                        $vedio_info['vedio_url'] = "https://player.vimeo.com/video/".$vimeoGetID;
                        $vedio_info['image_url'] = $array[0]['thumbnail_large'];

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_key = $user_name."_".$meta_clusters[0];  

                        //$video_post[$video_post_key] = ['videos' => $vedio_info];
                        //$vedios[$video_key] = $video_post;
                    }


                    if(array_key_exists($video_key, $vedios))
                    {
                        if(array_key_exists($meta_clusters[0], $different_user_video))
                        {
                            $different_user_video[$meta_clusters[0]][$video_post_key] = ['videos' => $vedio_info];
                            $vedios[$video_key] = [];
                            $vedios[$video_key] = $different_user_video[$meta_clusters[0]];
                        }
                        else
                        {
                            $video_post = [];
                            $video_post[$video_post_key] = ['videos' => $vedio_info];
                            $different_user_video[$meta_clusters[0]] = $video_post;
                            $vedios[$video_key] = $video_post;
                        }
                    }
                    else
                    {
                        if(count($vedios) > 0)
                        {
                            $video_post = [];
                            $video_post[$video_post_key] = ['videos' => $vedio_info];
                            $different_user_video[$meta_clusters[0]] = $video_post;
                            $vedios[$image_key] = $video_post;
                        }
                        else
                        {
                            $video_post[$video_post_key] = ['videos' => $vedio_info];
                            $different_user_video[$meta_clusters[0]] = $video_post;
                            $vedios[$video_key] = $video_post;                               
                        }
                    }



                }
                elseif($type == 'images')
                {
                    if(!is_null($meta->meta_value))
                    {
                        $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
                        $image_post_key = $meta_clusters[1]."_".$post_id;
                        $image_key = $user_name."_".$meta_clusters[0];

                        if(array_key_exists($image_key, $images))
                        {
                            if(array_key_exists($meta_clusters[0], $different_user_images))
                            {
                                $different_user_images[$meta_clusters[0]][$image_post_key] = ['images' => $images_info];
                                $images[$image_key] = [];
                                $images[$image_key] = $different_user_images[$meta_clusters[0]];
                            }
                            else
                            {
                                $image_post = [];
                                $image_post[$image_post_key] = ['images' => $images_info];
                                $different_user_images[$meta_clusters[0]] = $image_post;
                                $images[$image_key] = $image_post;
                            }
                        }
                        else
                        {
                            if(count($images) > 0)
                            {
                                $image_post = [];
                                $image_post[$image_post_key] = ['images' => $images_info];
                                $different_user_images[$meta_clusters[0]] = $image_post;
                                $images[$image_key] = $image_post;
                            }
                            else
                            {
                                $image_post[$image_post_key] = ['images' => $images_info];
                                $different_user_images[$meta_clusters[0]] = $image_post;
                                $images[$image_key] = $image_post;                                
                            }
                        }

                    }
                }
            }
        }

        $videos_arr['videos'] = $vedios;
        $images_arr['images'] = $images;


        $user_id = Auth::user()->id;
        $additional_info = AdditionalInfo::where('user_id',$user_id)->first()->toArray();    


        $data = [
            'additional_info'   => $additional_info
        ];

        if(!empty($images_arr))
        {
            $data['images'] = $images_arr;
        }

        if(!empty($videos_arr))
        {
            $data['vedios'] = $videos_arr;
        }


        $posts = Post::where('post_type','text')
                      ->whereIn('user_id',$followers)
                      ->orderBy('created_at', 'desc')->get();
        
        if(isset($posts))
        {
            if(!empty($posts))
            {
                $post_data = [];
                $index = 0;
                foreach ($posts as $post) 
                {
                    $post_data[$index] = [
                                            'id' => $post->id,
                                            'user_id' => $post->user_id,
                                            'user_name' => $post->user->name,
                                            'user_plan_code' => $post->user->plan_code,
                                            'post_category_id' => $post->post_category_id,
                                            'post_category_name' => $post->postCategory->name,
                                            'post_type' => $post->post_type,
                                            'title' => $post->title,
                                            'description' => utf8_encode($post->description),
                                            'image' => $post->image,
                                            'status' => $post->status,
                                            'created_at' => utf8_encode($post->created_at),
                                        ];
                    $index++;

                    $data['posts'] = $post_data;
                }
            }
        }

        return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }



    public function talent_listing()
    {
        $users = User::all();

        $follows = Follow::all();
        $followers = [];
        foreach ($users as $user) 
        {
            if(Auth::user()->id != $user->id)
            {
                foreach ($follows as $follow) 
                {
                    if($follow->follower_id == Auth::user()->id)
                    {
                        if(!in_array($follow->followed_id, $followers))
                        {
                            array_push($followers, $follow->followed_id);
                        }
                    }
                }
            }
        }
        $data = [
            'users'     => $users,
            'follows'    => $followers
        ];

        return view('local.fan.dashboard.talent_listing',$data);
    }

    public function follow(Request $request)
    {
        $input = $request->all();
        if(Auth::user()->id == $input['follower_id'])
        {
            $follow = Follow::firstOrCreate(
                [ 'follower_id' => $input['follower_id'] , 'followed_id' => $input['followed_id'] ]
            );
        }
        return redirect()->back();
    }

    public function unfollow(Request $request)
    {
        $input = $request->all();
        if(Auth::user()->id == $input['follower_id'])
        {
            if(Follow::where('follower_id',$input['follower_id'])->where('followed_id',$input['followed_id'])->first()->delete())
            {
                return redirect()->back();                
            }
        }
    }


}
