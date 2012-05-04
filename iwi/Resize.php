<?php


Yii::import('application.extensions.iwi.Storage');
class Resize extends CWidget
{

    public $path;
    public $x;
    public $y;
    const CACHE_FOLDER = 'images/site/cache/';
    public $method;

    function getValue()
    {
        $value = json_encode(array('name' => $this->path, 'size' => array($this->x, $this->y)));
        return str_replace('\\/', '/', $value);
    }

    function getExt()
    {
        $pathinfo = pathinfo($this->path);
        return $pathinfo['extension'];
    }

    function getKey()
    {
        return md5($this->method . $this->path . $this->x . $this->y);
    }

    public function run()
    {
        if ($this->path != "/" && !empty($this->path)) {
            $key = $this->getKey();
            $diskplace = Yii::getPathOfAlias('webroot') . $this->path; # E:/full/path/on/disk
            $hash_folders = substr($key, 0, 2) . '/' . substr($key, 2, 2) . '/'; # ab/bc
            $filename = $key . '.' . $this->getExt(); # hash.ext

            $dir = Resize::CACHE_FOLDER . $hash_folders; # images/site/cache/ab/bc/
            $fullpath = $hash_folders . $filename; # ab/bc/hash.ext

            if (!is_dir(YiiBase::getPathOfAlias('webroot').'/images/site/cache')) {
                mkdir(YiiBase::getPathOfAlias('webroot').'/images/site/cache', 0755, true);
            }
            Yii::app()->thumb->setThumbsDirectory('/images/site/cache');

            if(is_file($diskplace)){
                if (!Storage::model()->findByAttributes(array('key' => $key))) {

                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }

                    if (is_file($diskplace)) {


                        $method = $this->method;
                        Yii::app()->thumb
                            ->load($diskplace)
                            ->$method($this->x, $this->y)
                            ->save($fullpath);


                        $storage = new Storage();
                        $storage->key = $key;
                        $storage->value = $this->getValue();
                        $storage->save();
                    }
                }

                echo Yii::app()->createUrl(Resize::CACHE_FOLDER . $fullpath); # images/site/cache/ab/bc/hash.ext
            }

        }
    }
}