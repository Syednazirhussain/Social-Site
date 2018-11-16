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
use App\Models\Admin\Follow;

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
        $users = User::all();
        $follows = Follow::all();

        $followers = [];
        if(Auth::user()->plan_code == 'premium')
        {
            foreach ($users as  $user) 
            {
                foreach ($follows as $follow) 
                {
                    if($follow->followed_id == Auth::user()->id)
                    {
                        if(!in_array($follow->follower_id, $followers))
                        {
                            array_push($followers, $follow->follower_id);
                        }
                    }
                }
            }
        }
        else
        {
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
        }

        $user = Auth::user();

        $data = [
            'user'      => $user,
            'users'     => $users,
            'follows'   => $followers
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

    public function membership()
    {
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
        //$user->plan_code = 'premium';
        $user->image = 'default.png';
        if($user->save())
        {
        	$user->assignRole('Fans');
            //$user->assignRole('Talents');
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
