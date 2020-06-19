<?php

namespace common\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use Imagine\Image\ManipulatorInterface;
use yii\web\UploadedFile;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * Image helper
 * Works with directory @storage/images.
 */
class Image
{
	public static $imagesPath = '@storage/images/';
	public static $imagesUrl = '@storageUrl/images/';

	public static $cachePath = '@storage/cache/';
	public static $cacheUrl = '@storageUrl/cache/';

    /**
     * @param array|string $filePath the image path relative to the root storage directory
     * @param int $width
     * @param array $options
     * @param int $height
     * @param string $mode
     * @return string the generated image tag
     */
    public static function thumb($filePath, $options = [], $width = 200, $height = 200, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
    	$src = static::getThumbPath($filePath, $width, $height, $mode);

    	return Html::img($src, $options);
    }

    public static function getThumbPath($filePath, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
    	$imagesPath = Yii::getAlias(static::$imagesPath);
    	$cachePath = Yii::getAlias(static::$cachePath);

    	if(!file_exists($imagesPath . $filePath) || is_dir($imagesPath . $filePath)) {
    		return null;
    	}

    	$filename = pathinfo($filePath, PATHINFO_FILENAME);
    	$extension = pathinfo($filePath, PATHINFO_EXTENSION);
    	$thumbnail = $filename . '-' . $width . 'x' . $height . '.' . $extension;

    	if(!file_exists($cachePath . $thumbnail)) {
    		if(!is_dir($cachePath)) {
    			FileHelper::createDirectory($cachePath, 777);
    		}

    		\yii\imagine\Image::thumbnail($imagesPath . $filePath, $width, $height, $mode)
    		->save($cachePath . $thumbnail, ['quality' => 80]);
    	}

    	return Yii::getAlias(static::$cacheUrl . $thumbnail);
    }

    public static function getResized($filePath, $width, $height)
    {
    	$imagesPath = Yii::getAlias(static::$imagesPath);
    	$cachePath = Yii::getAlias(static::$cachePath);
    	if(!file_exists($imagesPath . $filePath) || is_dir($imagesPath . $filePath)) {
    		return null;
    	}
    	$filename = pathinfo($filePath, PATHINFO_FILENAME);
    	$extension = pathinfo($filePath, PATHINFO_EXTENSION);
    	$thumbnail = $filename . '-' . $width . 'x' . $height . '.' . $extension;
    	if(!file_exists($cachePath . $thumbnail)) {
    		if (!is_dir($cachePath)) {
    			FileHelper::createDirectory($cachePath, 777);
    		}
    		\yii\imagine\Image::getImagine()
    		->open($imagesPath . $filename .'.'. $extension)
    		->thumbnail(new Box($width, $height))
    		->save($cachePath . $thumbnail, ['quality' => 75]);
    	}
    	return Yii::getAlias(static::$cacheUrl . $thumbnail);
    }

    public static function upload(UploadedFile $fileInstance, $storageFolder = '')
    {
    	$imageName = time() . rand(1000, 9999) . '.' . $fileInstance->extension;
        // TODO: dopilit' $storageFolder = ''
    	$filePath = $imageName;
    	$imagesPath = Yii::getAlias(static::$imagesPath);

    	if($fileInstance->saveAs(FileHelper::normalizePath($imagesPath . $filePath))) {
    		return $filePath;
    	}
    }

    public static function getFullSize($filePath )
    {
        $imagesPath = Yii::getAlias(static::$imagesPath);

        if(!file_exists($imagesPath . $filePath) || is_dir($imagesPath . $filePath)) {
            return null;
        }

        return  Yii::getAlias(static::$imagesUrl).$filePath;
    }
}