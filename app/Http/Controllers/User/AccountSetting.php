<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Admin\AdditionalInfo;
use App\User;
use Auth;
use Flash;
use Session;

class AccountSetting extends Controller
{

    public function __construct()
    {
        $this->middleware('fan.route')->only('fan_edit');
        $this->middleware('fan.route')->only('fan_update');

        $this->middleware('talent.route')->only('talent_update');
        $this->middleware('talent.route')->only('talent_update');
    }

    public function fan_edit($id)
    {
    	if($id == Auth::user()->id)
    	{
    		$user = Auth::user();
	    	if($user->hasRole('Fans'))
	    	{
                $additional_info = AdditionalInfo::where('user_id',$id)->first();
                $data = [
                    'additional_info'   => $additional_info,
                    'user'              => $user
                ];
	    		return view('local.fan.dashboard.account',$data);
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

    public function fan_update($id,Request $request)
    {
        $input = $request->all();
        //dd($request->all());
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
                $additional_info = AdditionalInfo::where('user_id',$user->id)->first();
                $additional_info->about_us = $input['about_us'];
                (isset($input['facebook'])) ? $additional_info->facebook = $input['facebook'] : $additional_info->facebook = null;
                (isset($input['instagram'])) ? $additional_info->instagram = $input['instagram'] : $additional_info->instagram = null;
                (isset($input['linkdin'])) ? $additional_info->linkdin = $input['linkdin'] : $additional_info->linkdin = null;
                (isset($input['twitter'])) ? $additional_info->twitter = $input['twitter'] : $additional_info->twitter = null;
                if($additional_info->save())
                {
                    Flash::success('Account Setting updated successfully');
                    return redirect()->route('fan.account.setting',$user->id);
                }
                else
                {
                    Flash::error('There is some problem while updating additional Information');
                    return redirect()->route('fan.account.setting',$user->id);                    
                }
    		}
    		else
    		{
    			Flash::error('Account Setting were not updated successfully');
    			return redirect()->route('fan.account.setting',$user->id);
    		}
    	}
    	else
    	{
    		Flash::error('User not found');
    		return redirect()->route('fan.account.setting',$user->id);
    	}
    }


    public function talent_edit($id)
    {
        if($id == Auth::user()->id)
        {
            $user = Auth::user();
            if($user->hasRole('Talents'))
            {
                $additional_info = AdditionalInfo::where('user_id',$id)->first();
                $data = [
                    'additional_info'   => $additional_info,
                    'user'              => $user
                ];
                return view('local.talent.dashboard.account',$data);
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

    public function talent_update($id,Request $request)
    {
        $input = $request->all();
        //dd($request->all());
        $user = User::find($id);
        if(!empty($user))
        {
            if($user->hasRole('Talents'))
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
                    $additional_info = AdditionalInfo::where('user_id',$user->id)->first();
                    $additional_info->about_us = $input['about_us'];
                    (isset($input['facebook'])) ? $additional_info->facebook = $input['facebook'] : $additional_info->facebook = null;
                    (isset($input['instagram'])) ? $additional_info->instagram = $input['instagram'] : $additional_info->instagram = null;
                    (isset($input['linkdin'])) ? $additional_info->linkdin = $input['linkdin'] : $additional_info->linkdin = null;
                    (isset($input['twitter'])) ? $additional_info->twitter = $input['twitter'] : $additional_info->twitter = null;
                    if($additional_info->save())
                    {
                        Flash::success('Account Setting updated successfully');
                        return redirect()->route('talent.account.setting',$user->id);
                    }
                    else
                    {
                        Flash::error('There is some problem while updating additional Information');
                        return redirect()->route('talent.account.setting',$user->id);                    
                    }
                }
                else
                {
                    Flash::error('Account Setting were not updated successfully');
                    return redirect()->route('talent.account.setting',$user->id);
                }
            }
            else
            {
                Flash::error('User not found');
                return redirect()->route('talent.account.setting',$user->id);                
            }
        }
        else
        {
            Flash::error('User not found');
            return redirect()->route('talent.account.setting',$user->id);
        }
    }




}
