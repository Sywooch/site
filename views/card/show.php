<?php
/** @var $goods */


use yii\helpers\Url;
if (Yii::$app->session->hasFlash('success')){
    echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;
        </button>".Yii::$app->session->getFlash('success')."</div>";
}
elseif (Yii::$app->session->hasFlash('error')){
    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.Yii::$app->session->getFlash('error').'</div>';
}
if ($goods != null){

?>

    <div id="total">
        <table class="table">
        <tr>
            <td>Фото</td>
            <td>Наименование</td>
            <td>Количество</td>
            <td>Цена за шт</td>
            <td>Сумма</td>
            <td></td>
        </tr>
        <?php
        foreach ($goods as $id => $good) {?>

            <tr>
                <td><img src="<?=$good['img']?>"></td>
                <td><?=$good['name']?></td>
                <td><div style="float: left; margin-top: 15px;" ><?=$good['qty']?></div><div style="float: left"><div><button class="append" data-id="<?=$id?>"><span class="glyphicon glyphicon-chevron-up"></span></button></div><div><button class="reduce" onclick="reduceProductShow(<?=$good['qty']?>, <?=$id?>)"><span class="glyphicon glyphicon-chevron-down"></span></button></div></div></td>
                <td><?=$good['price']?></td>
                <td><?=$good['sum']?></td>
                <td><button class="del_product" data-id="<?=$id?>"><span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>


       <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td>Итого: <?=$_SESSION['purchases.total']?></td>
                <td></td>
                <td><h1>Общее количество товаров в корзине<?=$_SESSION['purchases.qty']?></h1></td>
            </tr>
        </table>
        <a href="/card/clear?clear=1"><button type="button" class="btn btn-primary">Очистить корзину</button> </a>
            <a href=<?=Url::to('/card/package')?>><button type="button" class="btn btn-success">Оформить заказ</button></a>

        <br />
        <br />

    </div >
    <?php
    }else {
        echo "<h1>Корзина пуста</h1>";
    }?>


