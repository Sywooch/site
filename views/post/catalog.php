<?php
    /** @var $goods*/
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\components\MenuWidget;
    use yii\widgets\LinkPager;
?>
<?//=$this->registerCssFile('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300')?>

<div id="cat_nav">
    <?=MenuWidget::widget()?>
    <div class="car2">


         <?=Html::img('@web/web/img/car.jpg', ['id' => 'car'])?>
        <div id="output">
             <?php foreach ($goods as $good) {?>
                    <div class="product">

                    <?php
                        $img = $good->getImage();
                    ?>
                    <img src="<?=$img->getUrl('100x100')?>">
                    <div class="title"><?php echo mb_substr($good->title, 0, 31).'...'?></div>
                    <div><?=$good->price?></div>
                    <div>
                        <?=Html::a('<input type="button" name="more" value="подробнее">', '@web/post/view?id='.$good->id )?>
                    </div>
                    <div style="text-align: center">
                        <a href="<?=Url::to(['card/add', 'id'=>$good->id])?>" class="purchase" data-id="<?=$good->id?>"><button>купить</button></a>
                    </div>
                 </div>
             <?php }?>

        </div>

        <div class="clear"></div>
<!--        <a href="--><?//=Url::to(['card/delete'])?><!--" class="del_product" data-key="--><?//=$key?><!--">удалить ключ </a>-->
        <!-- ЗДЕСЬ ВЫВОД ТОВАРОВ -->




        <div style="text-align: center"> <?=LinkPager::widget(['pagination'=>$pages])?></div>

        <div>
        <p>ГЛАВНАЯ СТРАНИЦА</p>

        <p>Добро пожаловать в интернет-магазин замечательных товаров!</p>

        <p>Мы с радостью принимаем и обслуживаем заказы 7 дней в неделю с 10 до 18 по московскому времени. Доставка возможна как по Москве, так и в регионы.</p>

        <p>Сделайте заказ через сайт и мы Вам перезвоним для согласования времени доставки заказа.</p>

        <p>Каталог наполнен несколькими товарами для демонстрации возможностей платформы InSales. Изменить структуру, удалить демонстрационные товары и добавить свои вы можете в разделе Товары -> Каталог на сайте.</p>

        <p>Для перехода в административный раздел (бэк-офис) интернет-магазина нажмите на ссылку Вход с паролем внизу страницы.</p>

        Отредактировать эту страницу Вы можете в разделе Сайт->Меню и страницы. Сменить дизайн магазина Вы можете в разделе Сайт -> Дизайн
        </div>
    </div>
    <div class="clear"></div>

</div>
<?=Html::style('#cat_nav{margin-top: 20px;}')?>


