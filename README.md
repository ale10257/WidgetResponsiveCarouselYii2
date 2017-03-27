## Очень легкий виджет для формирования карусели Yii2, c минимумом настроек

Реализована возможность вывода от 1 до n объектов одновременно (multiCarousel).

За основу взят скрипт https://github.com/basilio/responsiveCarousel#responsivecarousel

Также используется хелпер Image от https://github.com/noumo/easyii

Можно выводить как картинки, так и блоки текста и видео. Демо от автора скрипта responsivecarousel : http://basilio.github.io/responsiveCarousel/#examples
 
 Пример вызова виджета для формирования карусели c картинками
 
    $carousel = ResponsiveCarousel::widget([
    'items' => Carousel::items(),
    'size' => $data_slider, // $data_slider['width'] = ... $data_slider['height'] = ...
    ]);

Где items - это массив c объектами карусели, c публичными свойствами image, title, text, link

Size - массив c элементами width и height. Виджет проверяет соответствие картинок карусели переданным размерам, если размеры картинок не соответствуют width и height - они обрезаются

Пример вызова виджета для формирования карусели c текстовыми блоками, кол-во блоков в ряду - 4

    ResponsiveCarousel::widget([
	    'image' => false,
	    'containerOptions' => [
	        'id' => 'rewiews_main'
	    ],
	    'jsOptions' => [
	        'visible' => 4,
	        'itemMinWidth' => 200,
	        'itemMargin' => 15,
	        //'autoRotate' => 7000,
	        'speed' => 1000,
	    ]
    ])

В этом случае, кроме всего остального, мы передаем виджету id 'rewiews_main' уже сформированного блока, например

    <div id="reviews-title">
        <h3 style="text-align: center;">Header</h3>
        <a href="#" class="previous"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
    </div>
    <div id="rewiews_main" class="crsl-items" data-navigation="reviews-title">
        <div class="crsl-wrap">
            <? foreach ($last_reviews as $reviews) : ?>
                <section class="crsl-item">
		    		<?= reviews->text ?>
                </section>
            <?php endforeach ?>
        </div>
    </div>
    
Подробности про формирование html разметки и передаваемых параметрах на http://basilio.github.io/responsiveCarousel/#examples




