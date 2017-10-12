<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\MediaRepository;

class MediaController extends Controller
{
    private $model;
    public function __construct(MediaRepository $repository)
    {
        $this->model = $repository;
    }
    /**
     * 列表
     *
     * @return 视图
     */
    public function index()
    {
        $media = $this->model->paginate([
            'status' => 1,
        ]);

        return view('desktop::media.index')
            ->with('media', $media);
    }
    /**
     * Show Media
     *
     * @return 视图
     */
    public function show($id)
    {
        $media = $this->model->enabled($id);

        if (!$media) {
            return view('errors.404');
        }

        return view('desktop::media.show')
            ->with('media', $media);
    }
}
