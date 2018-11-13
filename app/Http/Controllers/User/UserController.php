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
use App\Models\Admin\PostCategory;
use App\Models\Admin\Post;
use App\Models\Admin\PostMeta;

class UserController extends Controller
{
    public function index()
    {
    	return view('user.site.index');
    }

    public function viewLogin()
    {
    	return view('user.auth.index');
    }

    public function dashboard()
    {
        $user = Auth::user();

        $additional_info = AdditionalInfo::where('user_id',$user->id)->first();
        $postCategories = PostCategory::all();

        $postMetas = PostMeta::all();

        //dd($postMetas);

        // $vedios = [];
        // $images = [];

        // foreach ($postMetas as $meta) 
        // {
        //     $meta_clusters = explode("_", $meta->meta_key);
        //     $type  = $meta_clusters[count($meta_clusters)-1];
        //     if($type == 'vedio')
        //     {
        //         $vedio_info = json_decode($meta->meta_value,true);
        //         $vedio_post_id = $meta_clusters[0];
        //         $vedios[$vedio_post_id] = $vedio_info;
        //     }
        //     elseif($type == 'images')
        //     {
        //         if(!is_null($meta->meta_value))
        //         {
        //             $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
        //             $image_post_id = $meta_clusters[1]."_".$meta_clusters[0];
        //             $images[$image_post_id] = $images_info;
        //         }
        //     }
        // }

        $posts = Post::all();
        $data = [
            'user'              => $user,
            'additional_info'   => $additional_info,
            'postCategories'    => $postCategories,
            'posts'             => $posts
        ];


    	return view('user.dashboard.index',$data);
    }

    public function verifyEmail(Request $request)
    {
    	$email = $request->remail;
        $user = User::where('email', $email)->first();

        if (count($user) > 0) {
            $success = 0;
            $response = 401;
        } else {
            $success = 1;
            $response = 200;
        }

        return response()->json(['success'=> $success, 'code'=>$response]);
    }

    public function membership(){
        return view('user.membership.pricing');
    }

    public function signUp(Request $request){

    	$this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'remail' => 'required|unique:users,email',
            'password' => 'required|string|min:6|max:20',
        ]);

        $input = $request->all();

    	$user = new User;
    	$user->name = $input['name'];
        $user->email = $input['remail'];
        $user->password = bcrypt($input['password']);
        $user->phone = $input['phone'];
        $user->status = 'active';
        $user->plan_code = 'free';
        $user->image = 'default.png';
        if($user->save())
        {
        	$user->assignRole('Fans');
        	Auth::login($user, true);
    
            $subscription = new Subscription;
            $subscription->user_id = $user->id;
            $subscription->plan_code = $user->plan_code;
            $subscription->status = $user->status;
            $subscription->renewal_date = date('Y-m-d');
            $subscription->renewed_date = date('Y-m-d', strtotime('+1 months'));
            $subcribe =  $subscription->save();

            $additional_info = new AdditionalInfo;
            $additional_info->user_id = $user->id;
            $additional = $additional_info->save();


            if( $subcribe == true && $additional == true )
            {
                Flash::success('User register successfully.');
                return redirect()->route('user.dashboard');                
            }
            else
            {
                Flash::error('User register but cannot subscribe');
                return redirect()->route('user.login');                
            }

        }
        else
        {
			Flash::error('User not saved successfully.');
			return redirect()->back();
        }

    }

    public function authenticate(Request $request){

    	$this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20',
        ]);

        $email    = $request->get("email");
        $password = $request->get("password");

        if (Auth::attempt(['email' => $email, 'password' => $password])) 
        {
            return redirect()->route('user.dashboard');
        } 
        else
        {
            Session::flash('errorMsg', 'Invalid Login Credentials.');
            return redirect()->back();
        }
    }


    public function logout(){

    	$user = Auth::user();
    	if($user->hasAnyRole(['Fans','Talents']))
    	{
    		Auth::logout();
    		return redirect()->route('site.dashboard');
    	}
    }

}
