<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Kaiwh\Media\Requests\DescriptionRequest;
use App\Repositories\MediaCategoryRepository as CategoryRepository;
use Illuminate\Http\Request;
use Redirect;

class MediaCategoryController extends Controller
{
    /**
     * @var categoryRepository
     */
    protected $repository;
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * 列表
     *
     * @return 视图
     */
    public function index()
    {
        $categories = $this->repository->all(['parent_id' => 0]);

        return view('admin::media.category.index')
            ->with('categories', $categories);
    }
    /**
     * 新增
     *
     * @return 视图
     */
    public function create(Request $request)
    {
        return view('admin::media.category.create');
    }
    /**
     * 添加分类
     *
     * @param Illuminate\Http\Request $request
     * @return Redirect
     */
    public function store(DescriptionRequest $request)
    {
        $this->repository->store($request->all());

        return Redirect::route('admin.media.category.index');
    }
    /**
     * 编辑
     *
     * @return 视图
     */
    public function edit(Request $request, $id)
    {
        $category = $this->repository->first($id);

        if (is_null($category)) {
            return Redirect::route('admin.media.category.index');
        }

        return view('admin::media.category.edit')
            ->with('category', $category);
    }
    /**
     * 修改分类
     *
     * @param Illuminate\Http\Request $request
     * @param Kai\Category\Models\Category $id
     * @return Redirect
     */
    public function update(DescriptionRequest $request, $id)
    {
        $category = $this->repository->first($id);

        if (!is_null($category)) {
            $this->repository->update($category, $request->all());
        }

        return Redirect::route('admin.media.category.index');
    }

    /**
     * 删除分类 (子类也会删除)
     *
     * @return 视图
     */
    public function destroy($id)
    {
        $category = $this->repository->first($id);

        if (!is_null($category)) {
            $this->repository->destroy($category);
        }

        return Redirect::route('admin.media.category.index');
    }
}
