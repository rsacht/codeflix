<?php

namespace  CodeFlix\Media;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

trait ThumbUploads
{
    public function uploadThumb($id, UploadedFile $file)
    {
        $model = $this->find($id);
        //Mover o arquivo para o local correto
        $this->upload($model, $file);
        //Se o nome existe
        if($name){
            $model->thumb = $name;
            $model->save();
        }
        return $model;
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