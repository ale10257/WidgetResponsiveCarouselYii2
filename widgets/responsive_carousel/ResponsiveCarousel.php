<?php
namespace app\components\widgets\responsive_carousel;

use yii;
use yii\base\Widget;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\View;
use app\components\helpers\image\Image;


class ResponsiveCarousel extends Widget
{

    /**
     * @var array
     *
     *======Options================
     *
     *@visible default 1    Number of items visible in the gallery.
     *
     *@speed default 'fast'    Animation speed between items.
     *
     *@overflow default false   Can set the overflow of the gallery, showing no visible elements.
     *
     *@autoRotate default false    This option allow you to change the items automatically. Value is the time interval in which the elements rotate.
     *
     *@navigation $(this).data('navigation')    Gets the id of the container paging buttons.
     *
     *@itemMinWidth default 0   Minimum width for each item. If the width of the item is less than the minimum, reduce the number of items visible.
     *
     *@itemEqualHeight default false    Calculate the height of the largest item and even all the elements.
     *
     *@itemMargin default 0    Distance between items
     *
     *@itemClassActive default 'crsl-active'    Class HTML for active item
     *
     *@imageWideClass default 'wide-image'  If you want 100% width images within each. CRSL-item, use this class or whatever you want.
     *
     *@carousel default true    You can disable default carousel behavior and use it to create a basic column system grid.
     *
     *@more http://basilio.github.io/responsiveCarousel/
     */

    public $jsOptions = [
        'autoRotate' => 7000,
        'speed' => 1000,
    ];

    public $jsPosition = View::POS_READY;

    public $items = [];

    public $containerOptions = [];

    public $image = true;

    public $size = [];

    public function init()
    {
        if ($this->image) {
            // not allowed empty Items
            if(empty($this->items)) {
                throw new Exception('Not allowed without items');
            }
            if (empty($this->size['width']) || empty($this->size['height'])) {
                throw new Exception('Fields width or height not be empty');
            }
            foreach ($this->items as $item) {
                Image::checkSizeFile($item->image, $this->size['width'], $this->size['height']);
            }
        }
    }

    /**
     * Register required scripts and css files for the ResponsiveCarousel
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        AssetResponsiveCarousel::register($view);
        $options = Json::encode($this->jsOptions);
        if(empty($this->containerOptions['id'])) {
            $this->containerOptions['id'] = $this->getId();
        }
        $id = $this->containerOptions['id'];
        $js = "$('#$id').responsiveCarousel($options);";
        $view->registerJs($js, $this->jsPosition);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();
        if ($this->image) {
            return $this->render('index', ['items' => $this->items, 'id' => $this->containerOptions['id']]);
        }
        return false;
    }

}