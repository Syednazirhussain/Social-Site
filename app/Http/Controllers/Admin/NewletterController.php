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

    public function send(Request $request)
    {
        $input = $request->all();

        $message = $input['message'];


        $ids = $input['users_id'];
        $errors = [];

        if(!empty($ids))
        {
            foreach ($ids as $user_id) 
            {

                $data['email'] = User::find($user_id)->email;
                $data['name'] = User::find($user_id)->name;
                $data['text'] = $message;

                try
                {
                    Mail::send('admin.email.newsletter',$data,function($message) use($data) {
                        $message->to($data['email'])->subject('Newsletter');
                    });
                    if(Mail::failures())
                    {
                        array_push($errors, 'User '.$data['name'].' having Id '.$user_id.' email were not send');
                    }
                }
                catch(\Exception $ex)
                {
                    array_push($errors, (string) $ex->getMessage() );
                }
            }

            $response = [
                'error'     => json_encode($errors),
                'status'    => 'success',
                'message'   => "Message has been sent to users email"
            ];
        }
        else
        {
            $response = [
                'status'     => 'fail',
                'message'   => "Message has been sent to users email"
            ];
        }

        return response()->json($response);
    }

}
