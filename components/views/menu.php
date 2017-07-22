
<?php
/** @var $id */
/** @var $cats */
use yii\helpers\Html; ?>

<div class="catalog">
    <span class="cell_of_cat">Каталог</span>
    <?php
        foreach ($cats as $cat){
            echo "<div class='cell_of_cat'>".Html::a($cat->cat, ['category/view?name='.$cat->cat_name.'&cat='.$cat->cat], ['class'=>'cell_a'])."</div>";
        }
    ?>

</div>
