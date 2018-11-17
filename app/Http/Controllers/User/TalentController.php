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
use App\Models\Admin\Follow;

class TalentController extends Controller
{
    public function __construct()
    {
        $this->middleware('talent.route');
    }

    public function dashboard()
    {

        $users = User::all();
        $follows = Follow::all();

        $followers = [];

        foreach ($users as  $user) 
        {
            foreach ($follows as $follow) 
            {
                if($follow->followed_id == Auth::user()->id)
                {
                    if(!in_array($follow->follower_id, $followers))
                    {
                        array_push($followers, $follow->follower_id);
                    }
                }
            }
        }

        $user = Auth::user();

        $data = [
            'user'      => $user,
            'users'     => $users,
            'follows'   => $followers
        ];


        return view('local.talent.dashboard.index',$data);
    }


    public function retrive_profile_info()
    {
        $postMetas = PostMeta::all();

        $vedios = [];
        $images = [];

        foreach ($postMetas as $meta) 
        {
            $meta_clusters = explode("_", $meta->meta_key);
            if(Auth::user()->id == $meta_clusters[0])
            {
                $type  = $meta_clusters[count($meta_clusters)-1];

                $user_name = '';
                $post_id = 0;
                $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));
                foreach ($meta->posts as  $post) 
                {
                    if($post->user->id == $meta_clusters[0])
                    {
                        $user_name = $post->user->name;
                        $post_id = $post->id;
                        break;
                    }
                }            

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

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;


                    }
                    elseif($vedio_info['vedio_type'] == 'dailymotion')
                    {
                        $original_url = $vedio_info['vedio_url'];
                        $lastSegment = basename(parse_url($original_url, PHP_URL_PATH));
                        $url = explode("_", $lastSegment);
                        $thumbnail_url = "http://www.dailymotion.com/thumbnail/video/".$url[0];
                        $vedio_info['vedio_url'] = "https://www.dailymotion.com/embed/video/".$url[0];
                        $vedio_info['image_url'] = $thumbnail_url;

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;
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

                        $video_post_key = $meta_clusters[1]."_".$post_id;
                        $video_post[$video_post_key] = ['videos' => $vedio_info];

                        $video_key = $user_name."_".$meta_clusters[0];                    
                        $vedios[$video_key] = $video_post;
                    }
                }
                elseif($type == 'images')
                {
                    if(!is_null($meta->meta_value))
                    {


                        $images_info = explode(",", str_replace([']','['],"", $meta->meta_value));

                        $image_post_key = $meta_clusters[1]."_".$post_id;
                        $image_post[$image_post_key] = ['images' => $images_info];

                        $image_key = $user_name."_".$meta_clusters[0];                    
                        $images[$image_key] = $image_post;

                    }
                }
            }
        }

        $videos_arr['videos'] = $vedios;
        $images_arr['images'] = $images;

        $user_id = Auth::user()->id;

        $additional_info = AdditionalInfo::where('user_id',$user_id)->first()->toArray();    
        $postCategories = PostCategory::all()->toArray();


        $data = [
            'postCategories'    => $postCategories,
            'additional_info'   => $additional_info
        ];

        if(!empty($images_arr))
        {
            $data['images'] = $images_arr;
        }

        if(!empty($videos_arr))
        {
            $data['vedios'] = $videos_arr;
        }

        $posts = Post::where('post_type','text')
                        ->where('user_id',$user_id)
                        ->orderBy('created_at', 'desc')->get();

        if(isset($posts))
        {
            if(!empty($posts))
            {
                $post_data = [];
                $index = 0;
                foreach ($posts as $post) 
                {
                    $post_data[$index] = [
                                            'id' => $post->id,
                                            'user_id' => $post->user_id,
                                            'user_name' => $post->user->name,
                                            'user_plan_code' => $post->user->plan_code,
                                            'post_category_id' => $post->post_category_id,
                                            'post_category_name' => $post->postCategory->name,
                                            'post_type' => $post->post_type,
                                            'title' => $post->title,
                                            'description' => utf8_encode($post->description),
                                            'image' => $post->image,
                                            'status' => $post->status,
                                            'created_at' => utf8_encode($post->created_at),
                                        ];
                    $index++;

                    $data['posts'] = $post_data;
                }
            }
        }

        return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function post_article(Request $request)
    {
    	$this->validate($request,[
            'post_category' => 'required',
            'article' => 'required'
        ]);

    	$user_id = Auth::user()->id;
    	$post_category_id = $request->input('post_category');

    	$post_type = 'text';

    	$post = new Post;
    	$post->user_id = $user_id;
    	$post->post_category_id = $post_category_id;
    	$post->post_type = $post_type;
    	$post->description = $request->input('article');
    	$post->status = 'active';
    	if($post->save())
    	{
    		//Flash::success('Post publish successfully');
    		return response()->json([
                'status'    => 'success',
                'message'   => 'Post publish successfully'
            ]);
    	}
    	else
    	{
    	    //Flash::error('Post were not publish');
    		return response()->json([
                'status'    => 'success',
                'message'   => 'Post were not publish'
            ]);	
    	}
    }

    public function edit_post($post_id)
    {
        if(!is_null($post_id))
        {
            $post = Post::find($post_id);
            $data = [
                'post'  => $post->toArray()
            ];
            return response()->json($data);
        }
    }

    public function update_post($post_id,Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'post_category' => 'required',
            'article' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else
        {
            if(!is_null($post_id))
            {
                $input = $request->all();
                if(Post::find($post_id)->update(['post_category_id' => $input['post_category'],'description' => $input['article']]))
                {
                    return response()->json([
                        'status'    => 'success',
                        'message'   => 'Post updated successfully'
                    ]);
                }
                else
                {
                    return response()->json([
                        'status'    => 'fail',
                        'message'   => 'Post cannot updated successfully'
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'errors'  => [
                                    'Post Id cannot found'
                                 ]
                ]);
            }
        }
    }

    public function delete_post($post_id)
    {
        if(!is_null($post_id))
        {
            if(Post::find($post_id)->delete())
            {
                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Post were removed successfully'
                ]);
            }
            else
            {
                return response()->json([
                    'status'    => 'fail',
                    'message'   => 'Post were not be removed'
                ]);
            }
        }
        else
        {
            return response()->json([
                'errors'  => [
                                'Post Id cannot found'
                             ]
            ]);
        }
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
                    $meta_key = $post->user_id."_".$date."_"."images";
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
		   	$meta_key = $post->user_id."_".$date."_"."vedio";

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



    public function talent_listing()
    {
        $users = User::all();

        $data = [
            'users'     => $users
        ];

        return view('local.talent.dashboard.talent_listing',$data);
    }




}
