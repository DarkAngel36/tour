<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 31.01.2019
 * Time: 18:27
 */

namespace common\models;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Yii;

class BaseModel extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    public $imgPath = 'matherials';

    public static function getStatusesList()
    {
        return [
            self::STATUS_ACTIVE => 'активно',
            self::STATUS_DISABLED => 'закрыто'
        ];
    }

    public function getStatusName()
    {
        $allStatuses = self::getStatusesList();
        return $allStatuses[$this->status];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function getTmpPath($add)
    {
        return \Yii::$app->basePath . 'tmp' . (!empty($add) ? '/' . $add . '/' : '');
    }

    public static function prepareImage($class, $id, $add)
    {
        FileHelper::createDirectory($class::getTmpImgPath("$id/$add"));
        $files = FileHelper::findFiles($class::getTmpImgPath("$id/$add"));
        $sizes = $class::getSizes();

        foreach($files as $file) {
            foreach($sizes[$add] as $size) {
                self::prepareImageSizes($class, $file, $size['w'], $size['h'], $class::getTmpImgPath("$id/$add"));
            }
        }

    }
    public static function prepareImageSizes($class, $fileName, $nw, $nh, $path)
    {
        $img = Image::getImagine()->open($fileName);
//        $w = $img->getSize()->getWidth();
//        $h = $img->getSize()->getHeight();
        $path .= $nw . 'x' . $nh;
        $tmp = explode('/', $fileName);
//        die(print_r($path));
        FileHelper::createDirectory($path);
        $img->thumbnail(new Box($nw, $nh), ImageInterface::THUMBNAIL_OUTBOUND/*THUMBNAIL_INSET*/)->save($path . "/" .$tmp[count($tmp)-1]);

        return true;
    }

    public function getImagesPreviewArr($add)
    {
        $initialPreview = [];
        $initialPreviewCfg = [];
        $class = self::className();
        
        $path = FileHelper::normalizePath($class::getTmpImgPath("{$this->id}//{$add}" ));

        FileHelper::createDirectory($path);
        if(is_dir($path)) {
            $images = FileHelper::findFiles($path, ['recursive' => false]);
            foreach ($images as $ind => $image) {
                $img = str_replace(FileHelper::normalizePath(\Yii::$app->basePath . '/../frontend/web'), \Yii::$app->params['front'], $image);
                $initialPreview[] = $img;
                $initialPreviewCfg[] = ['caption' => "img_$ind", 'key' => str_replace($path . DIRECTORY_SEPARATOR, '', $image)];
            }
        } else {
            die('path not found');
        }
        return ['initialPreview' => $initialPreview, 'initialPreviewCfg' => $initialPreviewCfg];
    }

    public function getImagesPreview($add, $size)
    {
        $initialPreview = [];
        $initialPreviewCfg = [];
        $class = self::className();

        $path = FileHelper::normalizePath($class::getTmpImgPath("{$this->id}//{$add}//{$size}" ));
//        die(print_r($path));
        FileHelper::createDirectory($path);
        if(is_dir($path)) {
            $images = FileHelper::findFiles($path, ['recursive' => false]);
            foreach ($images as $ind => $image) {
                $img = str_replace(FileHelper::normalizePath(\Yii::$app->basePath . '/../frontend/web'), \Yii::$app->params['front'], $image);
                $initialPreview[] = $img;
                $initialPreviewCfg[] = ['caption' => "img_$ind", 'key' => str_replace($path . DIRECTORY_SEPARATOR, '', $image)];
            }
        } else {
            die('path not found');
        }
        return ['initialPreview' => $initialPreview, 'initialPreviewCfg' => $initialPreviewCfg];
    }

    public function dropImage($img, $type)
    {

        $class = $this->className();
        $originalPath = FileHelper::normalizePath($class::getTmpImgPath("{$this->id}//{$type}" ));
        $sizes = $class::getSizes();

        foreach($sizes[$type] as $size) {
            $path = $originalPath . "/" .$size['w'] . 'x' . $size['h'];
            $fileName = "$path/$img";
//            die(print_r([$fileName]));
            if(file_exists($fileName)) {
                FileHelper::unlink($fileName);
            }
        }
//        print_r(["$originalPath\\$img"]);die();
        if(file_exists("$originalPath/$img")) {
            FileHelper::unlink("$originalPath/$img");
        }
    }

    public function beforeSave($insert)
    {
        if(!is_array($this->img_list)) {
            $tmp = explode(',', $this->img_list);
            foreach ($tmp as $key=>$value) {
                if(empty($value)) unset($tmp[$key]);
            }
            $this->img_list = $tmp;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $tmp_id = Yii::$app->request->post('tmp_id', null);
        if(empty($tmp_id)) $tmp_id = $this->tmp_id;
        if( $tmp_id != $this->id) {
            // apply new record

            $class = $this->className();
            $src = $class::getTmpImgPath($tmp_id);
            $dst = $class::getTmpImgPath($this->id);

//            die(print_r([$src, $dst]));
            if($dst != $src) {
                FileHelper::createDirectory($src);
                FileHelper::copyDirectory($src, $dst);
                FileHelper::removeDirectory($src);
            }

        }
        BaseModel::prepareImage(self::className(), $tmp_id, 'main');
        BaseModel::prepareImage(self::className(), $tmp_id, 'gallery');
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}