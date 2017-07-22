<?php
use yii\helpers\Url;
/** @var $goods */

if ($goods != null){


    ?>

<table class="table">
    <tr>
        <td>Фото</td>
        <td>Наименование</td>
        <td>Количество</td>
        <td>Цена за шт</td>
        <td>Сумма</td>
        <td></td>
    </tr>
    <div id="modal_card">
    <?php
    foreach ($goods as $key => $good) {?>

        <tr>
            <td><img src="<?=$good['img']?>"></td>
            <td><?=$good['name']?></td>
            <td><div style="float: left; margin-top: 15px;"><?=$good['qty']?></div><div style="float: left"><div><button class="append" data-id="<?=$key?>"><span class="glyphicon glyphicon-chevron-up"></span></button></div><div><button class="reduce" onclick="reduceProduct(<?=$good['qty']?>, <?=$key?>)"><span class="glyphicon glyphicon-chevron-down"></span></button></div></div><div class="clear"></div></td>
            <td><?=$good['price']?></td>
            <td><?=$good['sum']?></td>
            <td><button class="del_product" data-key="<?=$key?>"><span class="glyphicon glyphicon-remove"></span></button></td>
        </tr>


    <?php } ?>
    </div>
    <tr>
        <td></td>
        <td></td>
        <td>Итого: <?=$_SESSION['purchases.total']?></td>
        <td></td>
        <td></td>
    </tr>
</table>
<?php }
else{
    echo "<h1>Корзина пуста</h1>";
}