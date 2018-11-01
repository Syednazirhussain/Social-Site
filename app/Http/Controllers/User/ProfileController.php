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
    	    Flash::error('Post were not publish');
    		return redirect()->back();	
    	}
    }

    public function get_post_data()
    {
        $postMetas = PostMeta::all();

        $vedios = [];
        $images = [];

        foreach ($postMetas as $meta) 
        {
            $meta_clusters = explode("_", $meta->meta_key);
            $type  = $meta_clusters[count($meta_clusters)-1];
            if($type == 'vedio')
            {
                $vedio_info = json_decode($meta->meta_value,true);

                if($vedio_info['vedio_type'] == 'youtube')
                {
                    $url = $vedio_info['vedio_url'];
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                    {
                        $video_id = $match[1];
                    }
                    $thumbnail_url = "https://img.youtube.com/vi/".$video_id."/sddefault.jpg";
                    $vedio_info['vedio_url'] = "https://www.youtube.com/embed/".$video_id;
                    $vedio_info['image_url'] = $thumbnail_url;
                    $vedio_post_id = $meta_clusters[0];
                    $vedios[$vedio_post_id] = $vedio_info;
                }
                elseif($vedio_info['vedio_type'] == 'dailymotion')
                {
                    $original_url = $vedio_info['vedio_url'];
                    $lastSegment = basename(parse_url($original_url, PHP_URL_PATH));
                    $url = explode("_", $lastSegment);
                    $thumbnail_url = "http://www.dailymotion.com/thumbnail/video/".$url[0];
                    $vedio_info['vedio_url'] = "https://www.dailymotion.com/embed/video/".$url[0];
                    $vedio_info['image_url'] = $thumbnail_url;
                    $vedio_post_id = $meta_clusters[0];
                    $vedios[$vedio_post_id] = $vedio_info;
                }
                elseif($vedio_info['vedio_type'] == 'vimeo')
                {
                    $vimeo = $vedio_info['vedio_url']; 

                    $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                    $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                    $contents = @file_get_contents($url);
                    $array = @unserialize(trim($contents));
                    $vedio_info['vedio_url'] = "https://player.vimeo.com/video/".$vimeoGetID;
                    $vedio_info['image_url'] = $array[0]['thumbnail_large'];
                    $vedio_post_id = $meta_clusters[0];
                    $vedios[$vedio_post_id] = $vedio_info;
                }
            }
            elseif($type == 'images')
            {
                if(!is_null($meta->meta_value))
                {
                    $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
                    $image_post_id = $meta_clusters[1]."_".$meta_clusters[0];
                    $images[$image_post_id] = $images_info;
                }
            }
        }

        $data = [
            'images'    => $images,
            'vedios'    => $vedios
        ];
        return response()->json($data);
    }

    public function post_images(Request $request)
    {
    	$input = $request->all();

        if(!empty($input))
        {
            $files = [];
            $image_files = $input;

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
                        $response = [
                            'status'    => 'success',
                            'message'   => 'Post images uploaded successfully'
                        ];
                        return response()->json($response);                              
                    }
                    else
                    {
                        $response = [
                            'status'    => 'fail',
                            'message'   => 'There is some problem while uploading images'
                        ];
                        return response()->json($response);
                    }
                }
            }
            else
            {
                $response = [
                    'status'    => 'fail',
                    'message'   => 'There is some problem while uploading images'
                ];
                return response()->json($response);
            }

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
                $response = [
                    'status'    => 'success',
                    'message'   => 'Vedio added successfully'
                ];
	        	return response()->json($response);
		    }
		    else
		    {
	        	$response = [
                    'status'    => 'fail',
                    'message'   => 'There is some problem while saving vedio'
                ];
                return response()->json($response);
		    }
        }
        else
        {
            $response = [
                'status'    => 'fail',
                'message'   => 'Vedio cannot saved'
            ];
            return response()->json($response);
        }
    }

    public function post_image_destroy($post_id)
    {
    	if(isset($post_id))
    	{
    		if(!is_null($post_id))
    		{

    			$postMeta = PostMeta::where('post_id',$post_id)->first();
    			if(!empty($postMeta))
    			{
    				$images = explode(",", str_replace([']','['],"", $postMeta->meta_value));
    				foreach ($images as  $image) 
    				{
    					$file_path =  $_SERVER['SCRIPT_FILENAME'];
            			$file = str_replace("/index.php", "", $file_path)."/storage/posts/".trim($image,'"');
           
            			if(is_file($file))
			            {
			                unlink($file);
			            }
    				}
	    			if($postMeta->forceDelete())
	    			{
	    				Post::find($post_id)->forceDelete();
	    				return response()->json(['status' => 'success','message' => 'Image post deleted successfully']);
	    			}
    			}
    			else
    			{
    				return response()->json(['status' => 'fail','message' => 'There is some problem while deleting post images']);
    			}

    		}
    	}
    }



    public function post_image_remove(Request $request)
    {
    	$input = $request->all();

    	if(isset($input['image']))
    	{
    		$image_cluster = explode("/", $input['image']);
    		$image_name = $image_cluster[count($image_cluster)-1];
    		$post_id = $input['post_id'];
    		$postMeta = PostMeta::where('post_id',$post_id)->first();
    		
    		$images = explode(",", str_replace([']','['],"", $postMeta->meta_value));


    		$files = [];
    		for($i = 0; $i < count($images) ; $i++) 
    		{
    			if(trim($images[$i],'"') == $image_name)
    			{
    				$file_path =  $_SERVER['SCRIPT_FILENAME'];
        			$file = str_replace("/index.php", "", $file_path)."/storage/posts/".$image_name;
        			if(is_file($file))
		            {
		                unlink($file);
		            }
    			}
    			else
    			{
    				array_push($files, trim($images[$i],'"'));
    			}
    		}


    		if(empty($files))
    		{
    			if($postMeta->forceDelete())
    			{
    				Post::find($post_id)->forceDelete();
                    $response = [
                        'status' => 'success',
                        'message' => 'Image deleted successfully'
                    ];
	    			return response()->json($response);
    			}
    			else
    			{
                    $response = [
                        'status' => 'fail',
                        'message' => 'There is some problem while deleting image'
                    ];
	    			return response()->json($response);
    			}
    		}
    		else
    		{
    			$postMeta->meta_value = json_encode($files);
    		}

    		if($postMeta->save())
    		{
                $response = [
                    'status' => 'success',
                    'message' => 'Image deleted successfully'
                ];
	    		return response()->json($response);
    		}
    		else
    		{
                $response = [
                    'status' => 'fail',
                    'message' => 'There is some problem while deleting image'
                ];
	    		return response()->json($response);
    		}
    	}
    	else
    	{
            $response = [
                'status' => 'fail',
                'message' => 'There is some problem while deleting post images'
            ];
    	    return response()->json($response);	
    	}
    }


}
