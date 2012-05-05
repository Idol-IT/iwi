iwi
========

Idol Web Image Модуль для работы с изображениями.

Доступны два способа:  
* Resize - изменяет размер без учёта соотношения сторон.
* adaptiveResize - с учётом соотношения сторон, использует crop по центру при необходимости.


Установка
=========

1. Загрузить дамп.
2. Подключить в конфиге:

        'thumb' => array(
                    'class' => 'ext.iwi.phpthumb.EasyPhpThumb',
        ),
3. Радоваться


Пример использования
====================

    <?php $this->widget("ext.iwi.Resize",array(
                                'method' => 'adaptiveResize',
                                'path' => "/images/banner-01.jpg",
                                'x' => 100,
                                'y' => 100
                            ));  ?>