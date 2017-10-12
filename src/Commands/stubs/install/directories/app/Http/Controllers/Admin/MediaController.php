<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Kaiwh\Media\Requests\DescriptionRequest;
use App\Repositories\MediaRepository as MediaRepository;
use Illuminate\Http\Request;
use Redirect;

class MediaController extends Controller
{
    protected $repository;
    public function __construct(MediaRepository $repository)
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
        $media = $this->repository->paginate();

        return view('admin::media.media.index')
            ->with('media', $media);
    }
    /**
     * 新增
     *
     * @return 视图
     */
    public function create(Request $request)
    {
        return view('admin::media.media.create');
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

        return Redirect::route('admin.media.index');
    }
    /**
     * 编辑
     *
     * @return 视图
     */
    public function edit(Request $request, $id)
    {
        $media = $this->repository->first($id);

        if (is_null($media)) {
            return Redirect::route('admin.media.index');
        }

        return view('admin::media.media.edit')
            ->with('media', $media);
    }
    /**
     * 修改分类
     *
     * @param Illuminate\Http\Request $request
     * @param $id
     * @return Redirect
     */
    public function update(DescriptionRequest $request, $id)
    {

        $media = $this->repository->first($id);

        if (!is_null($media)) {
            $this->repository->update($media, $request->all());
        }

        return Redirect::route('admin.media.index');
    }

    /**
     * 删除分类 (子类也会删除)
     *
     * @return 视图
     */
    public function destroy($id)
    {
        $media = $this->repository->first($id);

        if (!is_null($media)) {
            $this->repository->destroy($media);
        }

        return Redirect::route('admin.media.index');
    }
}
