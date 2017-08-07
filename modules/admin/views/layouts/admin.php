<?php
use \yii\helpers\Html;
use app\assets\AppAsset;
use \yii\bootstrap\Modal;
use yii\helpers\Url;

/**
 * @property Good[] $goods
 */
AppAsset::register($this);
?>
<?php $this->beginPage()?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <title>Карбон админка</title>
        <meta charset="utf-8">
        <?=Html::csrfMetaTags()?>
        <!--	<link rel="stylesheet" type="text/css" href="/css/styles.css">-->
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div id="main">
        <div id="header">
            <a href="/post/catalog"><?= Html::img('@web/web/img/logo.png', ['alt' => 'Наш логотип', 'class' => 'head', 'id' => 'logo']) ?></a>
            <div class="head" id="topic_text">
                Тема для интернет-магазина на платформе InSales<br>
                Тема "Карбон" для интернет-магазина на платформе<br>
                InSales
            </div>
            <div class="head">
                +7 (495) 123 45 67<br>
                sales@insales.ru<br>
                c 10:00 до 19:00<br><br>
                <a href="<?=Url::to('/card/show')?>" id="basket">Корзина</a>
            </div>
            <div class="clear"></div>
        </div>
        <div id="navigation">

            <div class="cell"><?=Html::a('КАТЕГОРИИ', ['category/index'], ['class' => 'cell_a'])?></div>
            <div class="cell"><?=Html::a('СОЗДАТЬ КАТЕГОРИЮ', ['category/create'], ['class' => 'cell_a'])?></div>
            <div class="cell"><?=Html::a('ТОВАРЫ', ['good/index'], ['class' => 'cell_a'])?></div>
            <div class="cell"><?=Html::a('ДОБАВИТЬ ТОВАР', ['good/create'], ['class' => 'cell_a'])?></div>
            <?php if(!Yii::$app->user->isGuest):?>
                <div class="cell"><?=Html::a('<span class="glyphicon glyphicon-log-out"></span>Logout', ['/site/logout'], ['class' => 'cell_a'])?>
                    <?=Yii::$app->user->identity['username']?></div>
            <?php endif;?>

            <!--			<div id="search">-->
            <!--                --><?//= Html::beginForm(['order/update', 'id' => $id], 'post', ['enctype' => 'multipart/form-data']) ?>
            <!--                --><?//= Html::endForm()?>
            <!--			</div>-->
            <div class="clear"></div>
        </div>



        <?= $content ?>

        <!--         КОНТЕНТ          -->

        <div style="height: 800px; color: green;"></div>

    </div>

    <footer style="background-color: #363636;">
        <div id="footer_left">
            <div>Доставка</div>
            <div>Обратная связь</div>
            <div>Тема "Карбон" для интернет-магазина на InSales</div>
        </div>

        <div id="footer_right">
            <div>+7 (495) 123 45 67</div>
            <div>sales@insales.ru</div>
            <div>c 10:00 до 19:00</div>
            <div>Работает на InSales</div>
        </div>
        <div class="clear"></div>
        <div id="cart1">
            <div class="modal-body"></div>
        </div>
    </footer>
    <?php
    Modal::begin([
        'id' => 'cart',
        'header' => '<h2>Корзина</h2>',
        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                            '.Html::a('<button type="button" class="btn btn-primary">Оформить заказ</button>', ['card/show'], ['class'=>'cell_a']).'
                            <button type="button" id="clear_basket" class="btn btn-primary">Очистить корзину</button>'
    ]);
    Modal::end();
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>