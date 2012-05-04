iwi
========

Idol Web Image Модуль для работы с изображениями.
Доступны два способа: Resize и adaptiveResize.


Установка
=========

1. Загрузить дамп.
2. Подключить в конфиге

    'thumb' => array(
                'class' => 'ext.phpthumb.EasyPhpThumb',
    ),


Пример использования
====================

    <?php $this->widget("ext.iwi.Resize",array(
                                'method' => 'adaptiveResize',
                                'path' => "/images/banner-01.jpg",
                                'x' => 100,
                                'y' => 100
                            ));  ?>