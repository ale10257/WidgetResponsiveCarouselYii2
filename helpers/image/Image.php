<?php
namespace app\components\helpers\image;

use Yii;
use yii\web\HttpException;

class Image
{
    static function copyResizedImage($inputFile, $outputFile, $width, $height = null, $crop = true)
    {
        if (extension_loaded('gd') || extension_loaded('imagick')) {
            if (extension_loaded('imagick')) {
                $image = new \Imagick($inputFile);
                if ($height && !$crop) {
                    $image->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);
                } else {
                    $image->resizeImage($width, null, \Imagick::FILTER_LANCZOS, 1);
                }
                if ($height && $crop) {
                    $image->cropThumbnailImage($width, $height);
                }
                return $image->writeImage($outputFile);
            } else {
                $image = new GD($inputFile);
                if ($height) {
                    if ($width && $crop) {
                        $image->cropThumbnail($width, $height);
                    } else {
                        $image->resize($width, $height);
                    }
                } else {
                    $image->resize($width);
                }
                return $image->save($outputFile);
            }
        } else {
            throw new HttpException(500, 'Please install GD or Imagick extension');
        }
    }

    static function checkSizeFile($file, $width, $height)
    {
        if (is_file($file_path = Yii::getAlias('@webroot') . $file)) {
            list($w, $h) = getimagesize($file_path);
            if ($w == $width && $h == $height) {
                return $file;
            } else {
                if (self::copyResizedImage($file_path, $file_path, $width, $height)) {
                    return $file;
                }
            }
        }
        return null;
    }
}
