<?php

namespace common\traits;

use common\models\Challenge;
use common\models\Group;
use common\models\Photo;
use common\models\User;
use Yii;

trait FileTrait
{
    public static $photoOrig = 'users/photos/orig';
    public static $photoThumb = 'users/photos/thumb';
    public static $photoChallenge = 'challenges/photos';
    public static $photoOhSnap = 'ohsnap';

    public function getUploadsOhSnapPhoto()
    {
    	$baseUrl = sprintf('%s/%s', $this->getUploadsBaseUrl(), self::$photoOhSnap);
    	if ($this instanceof Photo) {
    		if ($this->file_url) {
    			return sprintf('%s/%s', $baseUrl, $this->file_url);
    		} else {
    			return "";
    		}
    	}
    }

    public function getUploadsGroupPhoto()
    {
        if ($this instanceof Group) {
        	$baseUrl = sprintf('%s/%s', $this->getUploadsBaseUrl(), self::$photoOhSnap);
        	
            if ($this->cover_photo) {
                return sprintf('%s/%s', $baseUrl, $this->cover_photo);
            } else {
                return "";
            }
        }
    }
    
    public function getUploadsChallengePhoto()
    {
    	$baseUrl = sprintf('%s/%s', $this->getUploadsBaseUrl(), self::$photoChallenge);
    	if ($this instanceof Challenge) {
    		if ($this->photo) {
    			return sprintf('%s/%s', $baseUrl, $this->photo);
    		} else {
    			return "";
    		}
    	}
    }

    public function getUploadsOrigPhoto()
    {
        $baseUrl = sprintf('%s/%s', $this->getUploadsBaseUrl(), self::$photoOrig);
        if ($this instanceof User) {
            if ($this->photo) {
                return sprintf('%s/%s', $baseUrl, $this->photo);
            } else {
                return sprintf('%s/%s', $baseUrl, 'default_user.png');
            }
        }
    }

    public function getUploadsThumbPhoto()
    {
        $baseUrl = sprintf('%s/%s', $this->getUploadsBaseUrl(), self::$photoThumb);
        if ($this instanceof User) {
            if ($this->photo) {
                return sprintf('%s/%s', $baseUrl, $this->photo);
            } else {
                return sprintf('%s/%s', $baseUrl, 'default_user.png');
            }
        }
    }

    public function getUploadsBaseUrl()
    {
        $baseUrl = sprintf('%s/' . Yii::$app->params['uploads.folder'], Yii::$app->request->getHostInfo());

        return $baseUrl;
    }

    public function getUploadsBasePath()
    {
        return Yii::getAlias('@uploads');
    }
	
    public function uploadsOhSnapPhotoBasePath($fileName, $absolute = true)
    {
    	if ($absolute) {
    		return sprintf('%s/%s/%s', $this->getUploadsBasePath(), self::$photoOhSnap, $fileName);
    	} else {
    		return sprintf('%s/%s', self::$photoOhSnap, $fileName);
    	}
    }
	
    public function uploadsChallengePhotoBasePath($fileName, $absolute = true)
    {
    	if ($absolute) {
    		return sprintf('%s/%s/%s', $this->getUploadsBasePath(), self::$photoChallenge, $fileName);
    	} else {
    		return sprintf('%s/%s', self::$photoChallenge, $fileName);
    	}
    }
    
    public function uploadsOrigPhotoBasePath($fileName, $absolute = true)
    {
        if ($absolute) {
            return sprintf('%s/%s/%s', $this->getUploadsBasePath(), self::$photoOrig, $fileName);
        } else {
            return sprintf('%s/%s', self::$photoOrig, $fileName);
        }
    }

    public function uploadsThumbPhotoBasePath($fileName, $absolute = true)
    {
        if ($absolute) {
            return sprintf('%s/%s/%s', $this->getUploadsBasePath(), self::$photoThumb, $fileName);
        } else {
            return sprintf('%s/%s', self::$photoThumb, $fileName);
        }
    }
} 