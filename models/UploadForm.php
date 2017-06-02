<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload() {
        if ($this->validate()) {

            foreach(glob('@web/images/fotosAnuncios/*.*') as $file) {
               exit($file);
            }
            

            $this->imageFile->saveAs('@web/images/fotosAnuncios/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}

?>