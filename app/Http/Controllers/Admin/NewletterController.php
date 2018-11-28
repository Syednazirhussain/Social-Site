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


class NewletterController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    public function index()
    {
        $users = User::all();
        $usersArr = [];
        foreach ($users as $user) 
        {
            if(!$user->hasAnyRole('Admin','Web Master'))
            {
                array_push($usersArr, $user);
            }
        }
        $data = [
            'users'    => $usersArr
        ];

        return view('admin.newsletters.index',$data);
    }

}
