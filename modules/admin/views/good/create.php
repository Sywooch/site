<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\Good */

$this->title = 'Create Good';
$this->params['breadcrumbs'][] = ['label' => 'Good', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
