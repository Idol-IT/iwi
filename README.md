iwi
========

Idol Web Image module for adaptive image resizing and caching in database, based on Kohana Image module.

Next methods are available:
* crop()
* rotate()
* flip()
* sharpen()
* quality()
* render()
* save()
* cache() requires a database

[Detailed documentation](http://docs.kohanaphp.com/libraries/image)

Installation
=========
1.Place 'iwi' folder into 'protected/extensions/'

2.Configuration (protected/config/main.php):

    'iwi' => array(
        'class' => 'application.extensions.iwi.IwiComponent',
        // GD or ImageMagick
        'driver' => 'GD',
        // ImageMagick setup path
        //'params'=>array('directory'=>'C:/ImageMagick'),
    ),


Usage
====================

    // loading
    Yii::import('ext.iwi.Iwi');
    $picture = new Iwi('images/sample.jpg');
    $picture->resize(100,100, Iwi::NONE);
    echo $picture->cache();

    // chainable usage in template
    echo Yii::app()->iwi->load("images/totem.png")->crop(70,121,'center')->cache();


Deprecated
====================

    $this->widget("ext.iwi.Resize");

Widget Resize is now derpecated.



Changelog
=====================

#### May 15, 2012

* Version 1.1 release
* New api
* ImageMagick support
* There is no need to perform a dump, it is performed automatically


#### May 10, 2012

* SQLite database support


#### May 4, 2012

* Release of 1.0 version