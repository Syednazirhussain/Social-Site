<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use Auth;
use Flash;
use Session;

class AccountSetting extends Controller
{
    public function edit($id)
    {
    	if($id == Auth::user()->id)
    	{
    		$user = Auth::user();
	    	if($user->hasAnyRole(['Fans','Talents']))
	    	{
	    		return view('user.dashboard.account',['user' => $user]);
	    	}
	    	else
	    	{
	    		Flash::error('Permission Denied');
	    		return redirect()->back();
	    	}
    	}
    	else
    	{
    		Flash::error('Permission Denied');
	    	return redirect()->back();
    	}

    }

    public function update($id,Request $request)
    {
    	$user = User::find($id);

    	if(!empty($user))
    	{
    		$user->name = $request->input('name');
    		$user->email = $request->input('remail');
    		$user->phone = $request->input('phone');
    		if($request->input('password_edit'))
    		{
    			$password = $request->input('password_edit');
    			if(!is_null($password))
    			{
    				$user->password = bcrypt($request->input('password_edit'));
    			}
    		}
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
    			Flash::success('Account Setting updated successfully');
    			return redirect()->route('user.account.setting',$user->id);
    		}
    		else
    		{
    			Flash::error('Account Setting were not updated successfully');
    			return redirect()->route('user.account.setting',$user->id);
    		}
    	}
    	else
    	{
    		Flash::error('User not found');
    		return redirect()->route('user.account.setting',$user->id);
    	}
    }
}
