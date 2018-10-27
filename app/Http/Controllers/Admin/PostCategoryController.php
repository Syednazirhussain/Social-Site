<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreatePostCategoryRequest;
use App\Http\Requests\Admin\UpdatePostCategoryRequest;
use App\Repositories\Admin\PostCategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PostCategoryController extends Controller
{
    /** @var  PostCategoryRepository */
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postCategoryRepository->pushCriteria(new RequestCriteria($request));
        $postCategories = $this->postCategoryRepository->all();

        return view('admin.post_categories.index')
            ->with('postCategories', $postCategories);
    }

    /**
     * Show the form for creating a new PostCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.post_categories.create');
    }

    /**
     * Store a newly created PostCategory in storage.
     *
     * @param CreatePostCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();

        $postCategory = $this->postCategoryRepository->create($input);

        Flash::success('Post Category saved successfully.');

        return redirect(route('admin.postCategories.index'));
    }

    /**
     * Display the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('admin.postCategories.index'));
        }

        return view('admin.post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('admin.postCategories.index'));
        }

        return view('admin.post_categories.edit')->with('postCategory', $postCategory);
    }

    /**
     * Update the specified PostCategory in storage.
     *
     * @param  int              $id
     * @param UpdatePostCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('admin.postCategories.index'));
        }

        $postCategory = $this->postCategoryRepository->update($request->all(), $id);

        Flash::success('Post Category updated successfully.');

        return redirect(route('admin.postCategories.index'));
    }

    /**
     * Remove the specified PostCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('admin.postCategories.index'));
        }

        $this->postCategoryRepository->delete($id);

        Flash::success('Post Category deleted successfully.');

        return redirect(route('admin.postCategories.index'));
    }
}
