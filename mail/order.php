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
                <td><img src="/web/upload/<?=$good['img']?>"></td>
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
</div>