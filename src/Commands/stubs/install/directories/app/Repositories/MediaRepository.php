<?php

namespace App\Repositories;

use App\Models\Media as Media;
use App\Models\MediaDescription as MediaDescription;
use App\Models\MediaImage as MediaImage;
use App\Models\MediaToCategory as MediaToCategory;
use DB;
use Kaiwh\Admin\Traits\Repository;

class MediaRepository
{
    use Repository;
    public function __construct(Media $media)
    {
        $this->model = $media;
    }
    /**
     * Filter eloquent
     *
     * @return Void
     */
    protected function filter($query, $filter)
    {
        if (isset($filter['status']) && !is_null($filter['status'])) {
            $query->where('status', (int) $filter['status']);
        }
    }

    /**
     * Store
     *
     * @return \App\Models\Media id
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $this->model->image  = $data['image'];
            $this->model->status = $data['status'];
            $this->model->save();

            // Description
            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {
                $descriptions[$code]                   = new MediaDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->description      = $value['description'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
            }
            $this->model->descriptions()->saveMany($descriptions);

            if (!empty($data['images'])) {
                $images = [];
                foreach ($data['images'] as $k => $value) {
                    $images[$k]             = new MediaImage;
                    $images[$k]->image      = $value['image'];
                    $images[$k]->title      = $value['title'];
                    $images[$k]->sort_order = (int) $value['sort_order'];
                }
                $this->model->images()->saveMany($images);
            }
            if (!empty($data['categories'])) {
                $categories = [];
                foreach ($data['categories'] as $k => $value) {
                    $categories[$k]              = new MediaToCategory;
                    $categories[$k]->category_id = $value;
                }
                $this->model->toCategories()->saveMany($categories);
            }
            return $this->model->id;
        });
    }
    /**
     * Update
     *
     * @return Void
     */
    public function update(Media $media, array $data)
    {
        DB::transaction(function () use ($media, $data) {
            $media->image  = $data['image'];
            $media->status = $data['status'];
            $media->save();

            // Description
            $media->descriptions()->delete();

            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {
                $descriptions[$code]                   = new MediaDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->description      = $value['description'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
            }
            $media->descriptions()->saveMany($descriptions);

            $media->images()->delete();
            if (!empty($data['images'])) {
                $images = [];
                foreach ($data['images'] as $k => $value) {
                    $images[$k]             = new MediaImage;
                    $images[$k]->image      = $value['image'];
                    $images[$k]->title      = $value['title'];
                    $images[$k]->sort_order = (int) $value['sort_order'];
                }
                $media->images()->saveMany($images);
            }
            $media->toCategories()->delete();
            if (!empty($data['categories'])) {
                $categories = [];
                foreach ($data['categories'] as $k => $value) {
                    $categories[$k]              = new MediaToCategory;
                    $categories[$k]->category_id = $value;
                }
                $media->toCategories()->saveMany($categories);
            }
        });
    }
    /**
     * Destroy
     *
     * @return Void
     */
    public function destroy(Media $media)
    {
        DB::transaction(function () use ($media) {
            $media->toCategories()->delete();
            $media->images()->delete();
            $media->descriptions()->delete();
            $media->delete();
        });
    }

    public function truncate()
    {
        MediaDescription::truncate();
        MediaToCategory::truncate();
        MediaImage::truncate();
        Media::truncate();
    }
}
