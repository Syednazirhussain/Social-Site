<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin\Subscription;

use Auth;
use Flash;
use Session;

use App\User;
use App\Models\Admin\AdditionalInfo;
use App\Models\Admin\Post;
use App\Models\Admin\PostCategory;
use App\Models\Admin\PostMeta;
use App\Models\Admin\Follow;

class FanController extends Controller
{

    function __construct()
    {
        $this->middleware('fan.route');
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

        $data = [
            'user'      => $user,
            'users'     => $users,
            'follows'   => $followers
        ];


        return view('local.fan.dashboard.index',$data);
    }


    public function get_post_data()
    {
        $postMetas = PostMeta::all();

        $vedios = [];
        $images = [];

        foreach ($postMetas as $meta) 
        {
            $meta_clusters = explode("_", $meta->meta_key);
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

        $videos_arr['videos'] = $vedios;
        $images_arr['images'] = $images;


        $user_id = Auth::user()->id;
        $additional_info = AdditionalInfo::where('user_id',$user_id)->first()->toArray();
        $postCategories = PostCategory::all()->toArray();
        $posts = Post::where('post_type','text')->orderBy('created_at', 'desc')->get();
        
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
        }


        $data = [
            'posts'             => $post_data,
            'postCategories'    => $postCategories,
            'additional_info'   => $additional_info,
            'images'            => $images_arr,
            'vedios'            => $videos_arr
        ];


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

        return view('user.dashboard.talent_listing',$data);
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