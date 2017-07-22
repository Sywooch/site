<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')?>

<?= $form->field($model, 'email')?>


<?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>


<?php ActiveForm::end(); ?>