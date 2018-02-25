<?php


namespace CodeFlix\Media;



trait SeriePaths
{

use VideoStorages;


    public function getThumbFolderStorageAttribute(){
    return "series/{$this->id}";
}

//Pega a pasta de armazenamento com o arquivo que foi gerado
    public function getThumbRelativeAttribute(){
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    public function getThumbSmallRelativeAttribute(){
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    //Mutator para pegar o caminho completo do arquivo
    public function getThumbPathAttribute(){
        return $this->getAbsolutePath($this->getStorage(), $this->thumb_relative);
    }
}