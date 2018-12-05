<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Admin\Subscription;
use Spatie\Permission\Models\Role;

use Mail;

class CronController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	foreach ($users as $user) 
    	{
    		if($user->hasRole('Talents') && $user->plan_code == 'premium')
    		{
    			$subcriptions = Subscription::where('code','premium')->get();
    			$flag = 0;
    			foreach ($subcriptions as $subcriptions) 
    			{	
    				if($subcriptions->user_id == $user->id)
    				{
    					$flag = 1;
    					$current_date = date('Y-m-d');
				    	$current_date = strtotime($current_date);
				    	$exp_date = strtotime( $subcriptions->renewed_date );
				    	$diff = $exp_date - $current_date;
				    	$days = floor($diff/(60*60*24));
				    	if($days == 7 || $days == 3 || $days == 1)
				    	{
				    		$data = [
				    			'name'	=> $user->name,
				    			'email'	=> $user->email,
				    			'days'	=> $days
				    		];
				    		Mail::send('email.remind',$data,function($message) use($data){
				    			$message->to($data['email'])->subject('Subscription expire in '.$data['days']);
				    		});
				    	}
				    	else
				    	{
				    		if($days == 1 || $days <= 0)
				    		{
				    			$user->syncRoles(['Fans']);
				    			User::find($user->id)->update(['plan_code' => 'free']);
				    			Subscription::find($subcriptions->id)->delete();
				    		}
				    	}
    				}
    				else
    				{
    					if($flag == 1)
    					{
    						break;
    					}
    				}
    			}
    		}
    	}
    }
}
