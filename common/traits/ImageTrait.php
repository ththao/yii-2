<?php
/**
 * @author Bryan Tan <bryantan16@gmail.com>
 */

namespace common\traits;

trait ImageTrait
{
    /**
     * method for doing batch resizes if its supported more than a 'thumbnail'
     * if the photo is empty it will skip the batch resize and it will return true
     *
     * @param string $src
     * @param string $dest
     * @return bool
     */
    public function batchResize($src, $dest)
    {
        if (!file_exists($src)) {
            return true;
        }
        return $this->resizeToThumb($src, $dest);
    }

    /**
     * resize to thumbnail
     *
     * @param string $src
     * @param string $dest
     * @return bool
     */
    public function resizeToThumb($src, $dest)
    {
        $exifData = @exif_read_data($src);
        if (isset($exifData['Orientation'])) {
            switch($exifData['Orientation']) {
                case 8:
                    $rotateVal = -90;
                    break;
                case 3:
                    $rotateVal = 180;
                    break;
                case 6:
                    $rotateVal = 90;
                    break;
                default:
                    $rotateVal = 0;
                    break;
            }
        } else {
            $rotateVal = 0;
        }

        $image = \yii\imagine\Image::thumbnail($src, 230, 230)->rotate($rotateVal)
            ->save($dest);

        if (is_object($image)) {
            return true;
        }
        return false;
    }
} 