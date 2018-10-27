<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Repositories\Admin\RoleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Spatie\Permission\Models\Role;
use App\Models\Admin\Permission;

class RoleController extends Controller
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roleRepository->pushCriteria(new RequestCriteria($request));
        $roles = $this->roleRepository->all();
        $permissions = Permission::all();
        $rolePermission = [];
        foreach ($roles as  $role) 
        {
            $name = $role->name;
            $myrole = Role::findByName($name);
            $assign = [];
            foreach ($permissions as  $permission) 
            {
                if ($myrole->hasPermissionTo($permission->name)) 
                {
                    array_push($assign, $permission->name);
                }
            }
            $rolePermission[$name] = $assign;           
        }

        $data = [
            'roles'                 => $roles,
            'rolePermissions'       => $rolePermission
        ];


        return view('admin.roles.index',$data);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $data = [
            'permissions'    => $permissions
        ];
        return view('admin.roles.create',$data);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
        $permissionArr = explode(",",$input['permissionArr']);
        $name = $input['name'];
        $role =  Role::create(['name' => $name]);
        if(count($role) > 0)
        {
            $role->syncPermissions($permissionArr);
            Flash::success('Role saved successfully.');
        }
        else
        {
            Flash::error('Role were not saved');
        }
        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        return view('admin.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = $this->roleRepository->findWithoutFail($id);
        if (empty($role)) 
        {
            Flash::error('Role not found');
            return redirect(route('admin.roles.index'));
        }
        $name = $role->name;
        $myrole = Role::findByName($name);
        $rolePermission = [];
        foreach ($permissions as  $permission) 
        {
            if ($myrole->hasPermissionTo($permission->name)) 
            {
                array_push($rolePermission, $permission->name);
            }
        }

        $data = [
            'role'               => $role,
            'rolePermissions'    => $rolePermission,
            'permissions'        => $permissions
        ];

        return view('admin.roles.edit',$data);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $input = $request->except(['_token','_method']);

        $this->validate($request,[
            'name' => 'required'
        ]);

        if(is_null($input['permissionArr']))
        {
            $error = \Illuminate\Validation\ValidationException::withMessages([
               'Permissions' => ['Please select atleat one permission']
            ]);
            throw $error;
            return redirect()->back();
        }

        $role = $this->roleRepository->findWithoutFail($id);
        if (empty($role)) 
        {
            Flash::error('Role not found');
            return redirect(route('admin.roles.index'));
        }
        $name = $role->name;
        $myrole = Role::findByName($name);
        $permissions = explode(",", $input['permissionArr']);
        $myrole->syncPermissions($permissions);
        unset($input['permissionArr']);
        $role = $this->roleRepository->update($input, $id);
        Flash::success('Role updated successfully.');
        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $permissions = Permission::all();
        $role = $this->roleRepository->findWithoutFail($id);
        if (empty($role)) 
        {
            Flash::error('Role not found');
            return redirect(route('admin.roles.index'));
        }
        $name = $role->name;
        $myrole = Role::findByName($name);
        $rolePermission = [];
        foreach ($permissions as  $permission) 
        {
            if ($myrole->hasPermissionTo($permission->name)) 
            {
                $myrole->revokePermissionTo($permission->name);
            }
        }        
        $this->roleRepository->delete($id);
        Flash::success('Role deleted successfully.');
        return redirect()->route('admin.roles.index');
    }
}
