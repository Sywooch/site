<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<div id="output">
    <?php foreach ($goods as $good) {?>
        <div>
            <?php//resize('../web/upload/'.$good['img'],100,100)?>
            <?=Html::img('@web/web/upload/'.$good['img'])?>
            <div><?=$good['price']?></div>
            <div>
                <?=Html::a('<input type="button" name="more" value="подробнее">', '@web/post/view?id='.$good['id'] )?>
                <a href="<?=Url::to(['card/index', 'id'=>$good['id']])?>">купить</a>
            </div>
        </div>
    <?php }?>

</div>