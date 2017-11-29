<?php

namespace  CodeFlix\Media;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;


trait ThumbUploads
{
    public function uploadThumb($id, UploadedFile $file)
    {
        $model = $this->find($id);
        //Mover o arquivo para o local correto
        $name = $this->upload($model, $file);
        //Se o nome existe
        if($name){
            $model->thumb = $name;
            $this->makeThumbSmall($model);
            $model->save();
        }
        return $model;
    }

    protected function makeThumbSmall($model){
        $storage = $model->getStorage();
        $thumbFile = $model->thumb_path;
        $format = \Image::format($thumbFile);
        $thumbnailSmall = \Image::open($thumbFile)->thumbnail(new Box(64, 36));
        $storage->put($model->thumb_small_relative, $thumbnailSmall->get($format));
    }

    public function upload($model, UploadedFile $file){
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();

        //Pegar a data/hora + id + nome original do arquivo + extensão
        $name = md5(time()."{$model->id}-{$file->getClientOriginalName()}") .".{$file->guessExtension()}";
        //storage/app/videos_test/serie/:id/
        $result = $storage->putFileAs($model->thumb_folder_storage, $file, $name);
        return $result ? $name: $result;
    }
}