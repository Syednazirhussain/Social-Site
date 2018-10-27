<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreatePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Repositories\Admin\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Admin\PostCategory;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $posts = $this->postRepository->all();

        return view('admin.posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $postCategory = PostCategory::all();

        $data = [
            'postCategorys'  => $postCategory
        ];

        return view('admin.posts.create',$data);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        $user_id = Auth::user()->id;

        $post = new Post;
        $post->title = $input['title'];
        $post->post_type = $input['post_type'];
        $post->post_category_id = $input['post_category_id'];
        $post->status = $input['status'];
        $post->user_id = $user_id;
        $post->description = $input['description'];
        if($request->hasFile('pic'))
        {
            $path = $request->file('pic')->store('/public/posts');
            $path = explode("/", $path);
            $count = count($path)-1;
            $post->image = $path[$count];
        }
        else
        {
            $post->image = null;
        }
        if($post->save())
        {
            Flash::success('Post saved successfully.');
            return redirect(route('admin.posts.index'));
        }
        else
        {
            Flash::error('Post were not be saved.');
            return redirect(route('admin.posts.index'));
        }
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('admin.posts.index'));
        }

        return view('admin.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) 
        {
            Flash::error('Post not found');
            return redirect(route('admin.posts.index'));
        }

        $postCategory = PostCategory::all();

        $data = [
            'post'           => $post,
            'postCategorys'  => $postCategory
        ];

        return view('admin.posts.edit',$data);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $input = $request->all();

        $post = Post::find($id);

        if (empty($post)) 
        {
            Flash::error('Post not found');
            return redirect(route('admin.posts.index'));
        }
        $user_id = Auth::user()->id;

        $post->title = $input['title'];
        $post->post_type = $input['post_type'];
        $post->post_category_id = $input['post_category_id'];
        $post->status = $input['status'];
        $post->user_id = $user_id;
        $post->description = $input['description'];
        if($request->hasFile('pic'))
        {

            $file_path =  $_SERVER['SCRIPT_FILENAME'];
            $file = str_replace("/index.php", "", $file_path)."/storage/posts/".$post->image;
            if(is_file($file))
            {
                unlink($file);
            }

            $path = $request->file('pic')->store('/public/posts');
            $path = explode("/", $path);
            $count = count($path)-1;
            $post->image = $path[$count];
        }
        if($post->save())
        {
            Flash::success('Post updated successfully.');
            return redirect(route('admin.posts.index'));
        }
        else
        {
            Flash::error('Post were not updated');
            return redirect(route('admin.posts.index'));
        }
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) 
        {
            Flash::error('Post not found');
            return redirect(route('admin.posts.index'));
        }

        $file_path =  $_SERVER['SCRIPT_FILENAME'];
        $file = str_replace("/index.php", "", $file_path)."/storage/posts/".$post->image;
        if(is_file($file))
        {
            unlink($file);
        }

        $this->postRepository->delete($id);
        Flash::success('Post deleted successfully.');
        return redirect(route('admin.posts.index'));
    }
}
