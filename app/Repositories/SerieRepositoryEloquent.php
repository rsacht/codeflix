<?php

namespace CodeFlix\Repositories;

use CodeFlix\Media\ThumbUploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;;
use CodeFlix\Models\Serie;

/**
 * Class SerieRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class SerieRepositoryEloquent extends BaseRepository implements SerieRepository
{
    use ThumbUploads;

    public function create(array $attributes)
    {
        $model =  parent::create(array_except($attributes, 'thumb_file'));
        $this->uploadThumb($model->id,$attributes['thumb_file']);
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Serie::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
