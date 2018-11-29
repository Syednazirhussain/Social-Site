<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\User;
use Auth;
use Flash;
use Session;

class ForumController extends Controller
{
    public function home()
    {

        return view('vendor.chatter.home',$data);
    }
}
