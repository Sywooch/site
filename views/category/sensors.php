<?php use app\components\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;  ?>
<?=MenuWidget::widget()?>
<div class="display_of_product">
<h1>Датчики</h1>

<?php
if($goods!=null) {
    foreach ($goods as $good) { ?>
        <div class="product">

            <?php
            $img = $good->getImage();
            ?>
            <img src="<?=$img->getUrl('100x100')?>">
            <div><?=$good->price?></div>
            <div>
                <?=Html::a('<input type="button" name="more" value="подробнее">', '@web/post/view?id='.$good->id )?><br>
                <a href="<?=Url::to(['card/add', 'id'=>$good->id])?>" class="purchase" data-id="<?=$good->id?>">купить</a>

            </div>
        </div>
    <?php }
}else{
    echo "товаров этой категории пока нет";
}?>
</div>
