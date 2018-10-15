<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use Session;
use App\User;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    public function adminLogin() 
    {
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return view('admin.login');
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
             return redirect()->route('admin.dashboard');

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
        Auth::logout();
        session()->flush();
        return redirect()->route('admin.login');
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

        $data = [
            'roles'     => $roles
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
        $user->password = $input['password'];
        if($user->save())
        {
            Flash::success('User saved successfully.');
            return redirect()->route('admin.users.index');
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
            'user'      => $user,
            'roles'     => $roles,
            'myrole'   => $myrole
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