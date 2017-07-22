<?php
    /** @var $good */
    use yii\helpers\Html;
    use yii\helpers\Url;

    //$this->registerCssFile('"@web/https://fonts.googleapis.com/css?family=Bellefair"');
?>
<div>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Slabo+27px');
    </style>
    <?php
    $img = $good->getImage();
    ?>
    <img src="<?=$img->getUrl('200x')?>" style="float: left">
    <div class="main_discr" style="float: left">
        <div class="title"><h2><?=$good->title?></h2></div>
        <div class="disciption"><?=$good->discr?></div>
    </div>



    <div style="float: right" class="price"><?=$good->price?>руб<br>
    <a href="<?=Url::to(['card/add', 'id'=>$good->id])?>" class="purchase" data-id="<?=$good->id?>">купить</a>
    </div>
    <div class="clear"></div>
</div>