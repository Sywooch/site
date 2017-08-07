<?php
/** @var $goods */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
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

            </tr>
            <?php
            foreach ($goods as $id => $good) {?>

                <tr>
                    <td><img src="<?=$good['img']?>"></td>
                    <td><?=$good['name']?></td>
                    <td><?=$good['qty']?></td>
                    <td><?=$good['price']?></td>
                    <td><?=$good['price']*$good['qty']?></td>
                </tr>


            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td>Итого: <?=$total?></td>
                <td></td>
                <td><h1>Общее количество товаров в корзине<?=$total_qty?></h1></td>
            </tr>
        </table>

        <br />
        <br />
        <?php $form = ActiveForm::begin()?>
        <?=$form->field($order, 'name')?>
        <?=$form->field($order, 'email')?>
        <?=$form->field($order, 'phone')?>
        <?=$form->field($order, 'address')?>
        <?=Html::submitButton('Заказать', ['class'=>'btn btn-success'])?>
        <?php ActiveForm::end()?>
    </div >
    <?php
}