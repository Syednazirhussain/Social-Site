<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Mail;
use Crypt;
use Auth;
use Flash;
use Session;
use App\User;
use App\Models\Admin\MemberShipPlan;
use App\Models\Admin\AdditionalInfo;
use App\Models\Admin\Subscription;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function account_setting($user_id)
    {
        $user = User::findOrFail($user_id);
        
        $data = [
            'user'  => $user
        ];

        return view('admin.settings.index',$data);
    }

    public function account_setting_update($user_id,Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:20|min:3',
            'email'  => 'required|email',
            'phone' => 'required'
        ]);

        $user = [
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ];

        if($request->has('password_edit'))
        {
            $password = bcrypt($request->input('password_edit'));
            $user['password'] = $password;
        }

        if($request->hasFile('pic'))
        {
            $me = User::find($user_id);
            if($me->image != 'default.png')
            {
                $file_path =  $_SERVER['SCRIPT_FILENAME'];
                $file = str_replace("/index.php", "", $file_path)."/storage/users/".$me->image;
                if(is_file($file))
                {
                    unlink($file);
                }
            }
            $path = $request->file('pic')->store('/public/users');
            $path = explode("/", $path);
            $count = count($path)-1;
            $user['image'] = $path[$count];
        } 

        if(User::find($user_id)->update($user))
        {
            Flash::success('Account setting update successfully');
            return redirect()->back();
        }
        else
        {
            Flash::error('Some thing went wrong');
            return redirect()->back();   
        }
    }

    public function forget_password()
    {
        return view('admin.auth.forget_password');     
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
            $input['reset_url'] = route('admin.reset.password',[$user_id]);
            $user->password = $new_password;
            $user->reset_password = 1;
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

    public function reset_password($user_id)
    {
        $data = [
            'user_id'   => $user_id
        ];
        return view('admin.auth.reset_password',$data);
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
                $user->reset_password = 0;
                if($user->save())
                {
                    Session::flash('successMsg','Your password successfully updated');
                    return redirect()->route('admin.login');                    
                }
                else
                {
                    Session::flash('errorMsg','Whoops. Some thing went to be wrong');
                    return redirect()->route('admin.login');
                }
            }
            else
            {
                Session::flash('errorMsg','Whoops. Some thing went to be wrong');
                return redirect()->route('admin.login');
            }
        }
        else
        {
            Session::flash('errorMsg','Whoops. Some thing went to be wrong');
            return redirect()->route('admin.login');
        }
    }

    public function adminLogin(Request $request) 
    {
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return view('admin.auth.login');
        }
    }

    public function adminAuth(Request $request) 
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
            if($user->reset_password == 0)
            {
                if($user->hasAnyRole(['Admin','Web Master']))
                {
                    return redirect()->route('admin.dashboard');
                }
                else
                {
                    Session::flash('errorMsg', 'Access Denied');
                    return view('admin.login');
                }
            }
            else
            {
                Session::flash('errorMsg', 'Please verify your password');
                return view('admin.login');
            }
        } 
        else
        {
            Session::flash('errorMsg', 'Invalid Login Credentials.');
            return redirect()->route('admin.login');
        }

    }

    public function dashboard() 
    {
        return view('admin.dashboard.dashboard');
    }

    /**
     * Logout the admin from admin panel
     *
     *
     * @return Redirect
     */
    public function logout()
    {    
        $user = Auth::user();
        if($user->hasAnyRole(['Admin','Web Master']))
        {
            Auth::logout();
            return redirect()->route('admin.login');
        }
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $users = $this->userRepository->all();

        $roles = Role::all();
        
        $userRole = [];
        foreach ($users as $user) 
        {
            foreach ($roles as $role) 
            {
                if($user->hasRole($role->name))
                {
                    $userRole[$user->name] =  $role->name;
                }
            }
        }

        $data = [
            'users'     => $users,
            'userRole'  => $userRole
        ];

        return view('admin.users.index',$data);
    }

    public function verifyEmail(Request $request)
    {
        $siteAdmin_email = $request->email;
        $user = User::where('email', $siteAdmin_email)->first();

        if (count($user) > 0) {
            $success = 0;
            $response = 401;
        } else {
            $success = 1;
            $response = 200;
        }

        return response()->json(['success'=> $success, 'code'=>$response]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        $memberships = MemberShipPlan::all();

        $data = [
            'roles'         => $roles,
            'memberships'   => $memberships
        ];



        return view('admin.users.create',$data);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->validate($request,[
            'name' => 'required|max:20|min:3',
            'email'  => 'required|unique:users,email',
        ]);

        $input = $request->all();

        $permissions = Permission::all();
        $user = new User;
        $user->assignRole($input['role']);
        $role = Role::findByName( $input['role'] );
        $rolePermission = [];
        foreach ($permissions as  $permission) 
        {
            if ($role->hasPermissionTo($permission->name)) 
            {
                array_push($rolePermission, $permission->name);
            }
        }
        $user->givePermissionTo($rolePermission);
        unset($input['role']);
        $input['password'] = bcrypt($input['password']);

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->phone = $input['phone'];
        $user->status = $input['status'];
        $user->plan_code = $input['plan_code'];
        if($request->hasFile('pic'))
        {
            $path = $request->file('pic')->store('/public/users');
            $path = explode("/", $path);
            $count = count($path)-1;
            $user->image = $path[$count];
        }   
        else
        {
            $user->image = "default.png";
        }

        if($user->save())
        {

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

            if( $subcribe == true && $additional == true )
            {
                Flash::success('User created successfully.');
                return redirect()->route('admin.users.index');                
            }
            else
            {
                Flash::error('User saved but not subscription');
                return redirect()->route('admin.users.index');                
            }

        }
        else
        {
            Flash::error('User not saved successfully.');
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $memberships = MemberShipPlan::all();
        if (empty($user)) 
        {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        $myrole = '';
        foreach ($roles as $role) 
        {
            if($user->hasRole($role->name))
            {
                $myrole =  $role->name;
            }
        }

        $data = [
            'user'          => $user,
            'roles'         => $roles,
            'myrole'        => $myrole,
            'memberships'   => $memberships
        ];

        return view('admin.users.edit',$data);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->validate($request,[
            'name' => 'required|max:20|min:3',
            'email'  => 'required|email',
        ]);

        $input = $request->except(['_token','_method']);

        $permissions = Permission::all();
        $user = User::find($id);

        if (empty($user)) 
        {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $new_role = [];
        array_push($new_role, $input['role']);
        $user->syncRoles($new_role);
        if( $user->hasRole($input['role']) )
        {
            $role = Role::findByName($input['role']);
            $rolePermission = [];
            foreach ($permissions as  $permission) 
            {
                if ($role->hasPermissionTo($permission->name)) 
                {
                    array_push($rolePermission, $permission->name);
                }
            }
            $role->syncPermissions($rolePermission);
        }

        unset($input['role']);
        if(isset($input['password_edit']) && $input['password_edit'] != null)
        {
            $input['password'] = bcrypt($input['password_edit']);
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        if(isset($input['password']))
        {
            $user->password = $input['password'];
        }
        $user->phone = $input['phone'];
        $user->status = $input['status'];
        $user->plan_code = $input['plan_code'];
        if($request->hasFile('pic'))
        {
            $file_path =  $_SERVER['SCRIPT_FILENAME'];
            $file = str_replace("/index.php", "", $file_path)."/storage/users/".$user->image;
            if(is_file($file))
            {
                unlink($file);
            }

            $path = $request->file('pic')->store('/public/users');
            $path = explode("/", $path);
            $count = count($path)-1;
            $user->image = $path[$count];
        } 


        if($user->save())
        {
            Flash::success('User updated successfully.');
            return redirect()->route('admin.users.index');
        }
        else
        {
            Flash::error('User not updated successfully.');
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('admin.users.index'));
    }
}
