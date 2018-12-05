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
use App\Models\Admin\MemberShipPlan;


use Mail;
use Crypt;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('fan.route')->only('fan_logout');
        $this->middleware('talent.route')->only('talent_logout');
    }

    public function viewLogin()
    {
    	return view('local.auth.index');
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

    public function forget_password()
    {
        return view('local.auth.forget_password');     
    }

    public function password_request(Request $request)
    {
        $input = $request->except(['_token']);

        $email = $input['email'];
        $user = User::where('email',$email)->first();
        if(!empty($user))
        {
            $input['name'] = $user->name;
            $new_password = $this->generateRandomString();
            $input['password'] = $new_password;
            $user_id = Crypt::encrypt($user->id);
            $input['reset_url'] = route('user.reset.password',[$user_id]);
            $user->password = $new_password;
            if($user->save())
            {   
                Mail::send('email.forget_password' , $input, function($message) use( $input ) {
                     $message->to($input['email'])->subject('Reset Password');
                });
                if(Mail::failures()) 
                {
                    Session::flash('errorMsg','Some thing went to be wrong');
                    return redirect()->back();
                }
            }
        }

        Session::flash('successMsg','We have sent reset password details to your email');
        return redirect()->back();
    }

    public function reset_password($user_id)
    {
        $data = [
            'user_id'   => $user_id
        ];
        return view('local.auth.reset_password',$data);
    }

    public function reset_password_request(Request $request)
    {
        $input = $request->except(['_token']);

        $user_id = Crypt::decrypt($input['user_id']);

        $user = User::find($user_id);
        if(!empty($user))
        {
            if($user->password == $input['password'])
            {
                $user->password = bcrypt($input['password']);
                if($user->save())
                {
                    Session::flash('successMsg','Your password successfully updated');
                    return redirect()->route('user.login');                    
                }
                else
                {
                    Session::flash('errorMsg','Whoops. Some thing went to be wrong');
                    return redirect()->route('user.login');
                }
            }
            else
            {
                Session::flash('errorMsg','Whoops. Some thing went to be wrong');
                return redirect()->route('user.login');
            }
        }
        else
        {
            Session::flash('errorMsg','Whoops. Some thing went to be wrong');
            return redirect()->route('user.login');
        }
    }

    public function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function verify_account($user_id,$token)
    {
        $id = Crypt::decrypt($user_id);
        $token = Crypt::decrypt($token);

        $user  = User::findOrFail($id);
        if(!empty($user))
        {
            if($user->token == $token)
            {
                $user->token = null;
                $user->status = 'active';
                if($user->save())
                {

                    $data = [
                        'name'  => $user->name,
                        'email' => $user->email
                    ];

                    Mail::send('email.account_confirmation',$data,function($message) use($data){
                        $message->to($data['email'])->subject('Account verifed successfully');
                    });

                    $user->assignRole('Fans');
                    //$user->assignRole('Talents');

                    $memberShip_id = MemberShipPlan::where('code','free')->first()->id;
                    
                    $subcribe = Subscription::firstOrCreate([
                        'user_id'       => $user->id,
                        'code'          => $user->plan_code,
                        'membership_id' => $memberShip_id,
                        'status'        => $user->status,
                        'renewal_date'  => date('Y-m-d'),
                        'renewed_date'  => date('Y-m-d', strtotime('+1 months'))
                    ]);

                    $additional = AdditionalInfo::firstOrCreate([
                        'user_id'   => $user->id
                    ]);

                    Auth::login($user, true);

                    if( $subcribe == true && $additional == true )
                    {
                        Flash::success('User register successfully.');
                        return redirect()->route('fan.user.dashboard');                
                    }
                    else
                    {
                        Flash::error('User register but cannot subscribe');
                        return redirect()->route('user.login');                
                    }
                }
                else
                {
                    Session::flash('errorMsg','There is some problem to confirm your account');
                    return redirect()->route('user.login');
                }
            }
            else
            {
                Session::flash('errorMsg','Bad request');
                return redirect()->route('user.login');
            }
        }   
        else
        {
            Session::flash('errorMsg','Bad request');
            return redirect()->route('user.login');
        }
    }

    public function signUp(Request $request)
    {

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
        $user->status = 'inactive';
        $user->plan_code = 'free';
        $user->image = 'default.png';
        $user->token = $this->generateRandomString();
        if($user->save())
        {
            $encrypt_id = Crypt::encrypt($user->id);
            $encrypt_token = Crypt::encrypt($user->token);

            $data = [
                'name'  => $user->name,
                'email' => $user->email,
                'link'  => route('user.verify.email',[$encrypt_id,$encrypt_token])
            ];

            Mail::send('email.verify_email',$data,function($message) use($data){
                $message->to($data['email'])->subject('Account verification');
            });

            if(Mail::failures())
            {
                Session::flash('errorMsg','Please verify your email to continue');
                return redirect()->back();
            }
            else
            {
                Session::flash('successMsg','We have sent an email to confirm your account');
                return redirect()->back();   
            }
        }
        else
        {
            Session::flash('errorMsg','Registeration fail');
            return redirect()->back();
        }
    }

    public function accountConfirmation()
    {
        $user = Auth::user();
        if(!empty($user))
        {
            $encrypt_id = Crypt::encrypt($user->id);
            $encrypt_token = Crypt::encrypt($user->token);

            $data = [
                'name'  => $user->name,
                'email' => $user->email,
                'link'  => route('user.verify.email',[$encrypt_id,$encrypt_token])
            ];

            Mail::send('email.verify_email',$data,function($message) use($data){
                $message->to($data['email'])->subject('Account verification');
            });

            if(Mail::failures())
            {
                Session::flash('errorMsg','Please verify your email to continue');
                return redirect()->back();
            }
            else
            {
                Session::flash('successMsg','We have sent an email to confirm your account');
                return redirect()->back();   
            }
        }
        else
        {
            Session::flash('errorMsg','Access Denied');
            return redirect()->back();
        }

    }

    public function authenticate(Request $request)
    {
    	$this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20',
        ]);


        $email    = $request->get("email");
        $password = $request->get("password");
        if (Auth::attempt(['email' => $email, 'password' => $password])) 
        {
            $user = Auth::user();
            if($user->hasRole('Talents'))
            {
                return redirect()->route('talent.user.dashboard');
            }
            else
            {
                $user = Auth::user();
                if($user->status == 'inactive')
                {
                    Session::flash('errorMsg', 'Please verify your account.');
                    Session::flash('sendMail',route('user.account.confirmation'));
                    return redirect()->back();
                }
                else
                {
                    return redirect()->route('fan.user.dashboard');
                }
            }

        } 
        else
        {
            Session::flash('errorMsg', 'Invalid Login Credentials.');
            return redirect()->back();
        }
    }

    public function fan_logout()
    {
        $user = Auth::user();
        if($user->hasRole('Fans') && $user->plan_code == 'free')
        {
            Auth::logout();
            return redirect()->route('site.dashboard');
        }
    }
    public function talent_logout()
    {
        $user = Auth::user();
        if($user->hasRole('Talents') && $user->plan_code == 'premium')
        {
            Auth::logout();
            return redirect()->route('site.dashboard');
        }
    }

}
