<div class="crsl-items" id="<?= $id ?>" data-navigation="nav-responsive-carousel">
    <div id="nav-responsive-carousel" class="crsl-nav">
        <a href="#" class="previous"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
    </div>
    <div class="crsl-wrap">
        <? foreach ($items as $item) : ?>
            <figure class="crsl-item">
                <?php if ($item->link) : ?>
                <a href="<?= $item->link ?>">
                    <? endif ?>
                    <img class="wide-image" src="<?= $item->image ?>">
                    <?php if (!empty($item->title) || !empty($item->text)) : ?>
                        <figcaption>
                            <?php if (!empty($item->title)) : ?>
                                <h3><?= $item->title ?></h3>
                            <? endif ?>
                            <?php if (!empty($item->text)) : ?>
                                <p><?= $item->text ?></p>
                            <? endif ?>
                        </figcaption>
                    <? endif ?>
                    <?php if ($item->link) : ?>
                </a>
            <? endif ?>

            </figure>
        <? endforeach ?>
    </div>
</div>


