iwi
========

Idol Web Image module for adaptive image resizing.

Two methods are available:  
* Resize - changes the size without width and height ratio.
* adaptiveResize - changes the size with width and height ratio, also crops center of the image.


Installation
=========

1. Import SQL dump to MySQL DB.
2. configuration (protected/config/main.php):

        'thumb' => array(
                    'class' => 'ext.iwi.phpthumb.EasyPhpThumb',
        ),
3. Enjoy


Example
====================

    <?php $this->widget("ext.iwi.Resize",array(
                                'method' => 'adaptiveResize',
                                'path' => "/images/banner-01.jpg",
                                'x' => 100,
                                'y' => 100
                            ));  ?>