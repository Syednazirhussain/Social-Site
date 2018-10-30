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
use App\Models\Admin\PostMeta;

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

    	// $post_category_name = PostCategory::find($post_category_id)->name;
    	// $post_type = str_replace(" ", "_", strtolower($post_category_name));

    	$post_type = 'text';

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

    public function post_images(Request $request)
    {
    	$input = $request->all();
    	if(isset($input['images']))
    	{
    		if(is_array($input['images']))
    		{
    			if(!empty($input['images']))
    			{
	    			$files = [];
	    			$image_files = $input['images'];

	    			foreach ($image_files as $file) 
	    			{
	    				$path = $file->store('public/posts');
	    				$pathArr = explode('/', $path);
	                    $count = count($pathArr);
	                    $path = $pathArr[$count - 1];
	                    array_push($files, $path);
	    			}

	    			$post_category_id = PostCategory::where('name','Un categorized')->first()->id;

	    			$post = new Post;
	    			$post->user_id = Auth::user()->id;
	    			$post->post_type = 'image';
	    			$post->post_category_id = $post_category_id;
	    			$post->status = 'active';
	    			if($post->save())
	    			{
		    			if(!empty($files))
		    			{
		    				$date = date('Y-m-d',strtotime($post->created_at));
		    				$meta_key = $post->id."_".$date."_"."images";
		    				$postMeta = new PostMeta;
		    				$postMeta->post_id = $post->id;
		    				$postMeta->meta_key = $meta_key;
		    				$postMeta->meta_value = json_encode($files);
		    				if($postMeta->save())
		    				{
					    		Flash::success('Images upload successfully');
					    		return redirect()->back();		    					
		    				}
		    				else
		    				{
				    			Flash::error('There is some problem while uploading image');
					    		return redirect()->back();
		    				}
		    			}
	    			}
	    			else
	    			{
			    		Flash::error('There is some problem while uploading image');
			    		return redirect()->back();
	    			}
    			}
    			else
    			{
		    		Flash::error('Please upload atleast single image');
		    		return redirect()->back();
    			}
    		}
    		else
    		{
	    		Flash::error('Please upload atleast single image');
	    		return redirect()->back();
    		}
    	}
    	else
    	{
    		Flash::error('Please upload atleast single image');
    		return redirect()->back();
    	}
    }

    public function post_vedio(Request $request)
    {
    	$this->validate($request,[
            'title' => 'required',
            'vedio_type' => 'required',
            'vedio_url' => 'required'
        ]);

        $input = $request->except(['_token']);

       	$post_category_id = PostCategory::where('name','Un categorized')->first()->id;

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->post_type = 'vedio';
        $post->post_category_id = $post_category_id;
        $post->status = 'active';
        if($post->save())
        {
        	$date = date('Y-m-d',strtotime($post->created_at));
		   	$meta_key = $post->id."_".$date."_"."vedio";

		    $postMeta = new PostMeta;
		    $postMeta->post_id = $post->id;
		    $postMeta->meta_key = $meta_key;
		    $postMeta->meta_value = json_encode($input);
		    if( $postMeta->save() )
		    {
	        	Flash::success('Vedio added successfully');
	        	return redirect()->back();
		    }
		    else
		    {
	        	Flash::error('There is some problem while saving vedio');
	        	return redirect()->back();
		    }
        }
        else
        {
        	Flash::error('Vedio cannot saved');
        	return redirect()->back();
        }
    }
}
