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
use App\Models\Admin\Post;
use App\Models\Admin\PostCategory;

class ProfileController extends Controller
{
    public function post_article(Request $request)
    {
    	$this->validate($request,[
            'post_category' => 'required',
            'article' => 'required'
        ]);

    	$user_id = Auth::user()->id;
    	$post_category_id = $request->input('post_category');
    	$post_category_name = PostCategory::find($post_category_id)->name;

    	$post_type = str_replace(" ", "_", strtolower($post_category_name));

    	$post = new Post;
    	$post->user_id = $user_id;
    	$post->post_category_id = $post_category_id;
    	$post->post_type = $post_type;
    	$post->description = $request->input('article');
    	$post->status = 'active';
    	if($post->save())
    	{
    		Flash::success('Post publish successfully');
    		return redirect()->back();
    	}
    	else
    	{
    	    Flash::success('Post were not publish');
    		return redirect()->back();	
    	}


    }
}
