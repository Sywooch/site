<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 07.07.2017
 * Time: 20:45
 */

namespace app\models;


use yii\db\ActiveRecord;

class Card extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    public function addToCard($good, $qty=1){
        if (isset($_SESSION['purchases'][$good->id])){
            $_SESSION['purchases'][$good->id]['qty']+=$qty;
        }else{
            $_SESSION['purchases'][$good->id] = [
                'qty' => $qty,
                'name' => $good->title,
                'price' => $good->price,
                'img'=> $good->getImage()->getUrl('100x'),
            ];
        }

        $_SESSION['purchases.qty'] = isset($_SESSION['purchases.qty']) ? $_SESSION['purchases.qty'] + $qty : $qty;
        $_SESSION['purchases'][$good->id]['sum'] = isset($_SESSION['purchases'][$good->id]['sum']) ? $_SESSION['purchases'][$good->id]['sum'] + $good->price*$qty
            : $good->price*$_SESSION['purchases'][$good->id]['qty'];
        $_SESSION['purchases.total'] = isset($_SESSION['purchases.total']) ? $_SESSION['purchases.total'] + $good->price*$qty
            : $good->price*$_SESSION['purchases'][$good->id]['qty'];

    }
    //если меняем кол-во товаров в корзине
    public function countUp($good, $action, $qty=1){
        if($action=='plus'){
            $_SESSION['purchases.total'] =  $_SESSION['purchases.total'] + $good->price*$qty;
            $_SESSION['purchases.qty'] = isset($_SESSION['purchases.qty']) ? $_SESSION['purchases.qty'] + $qty : $qty;
        }
        else{
            $_SESSION['purchases.total'] =  $_SESSION['purchases.total'] - $good->price*$qty;
            if (isset($_SESSION['purchases.qty'])) {
                $_SESSION['purchases.qty'] = $_SESSION['purchases.qty'] - $qty ;
            }
        }

        //если удаляем продукт из корзины
    }public function reCount($good){
        $_SESSION['purchases.qty'] = $_SESSION['purchases.qty'] - $_SESSION['purchases'][$good->id]['qty'];
        $_SESSION['purchases.total'] =  $_SESSION['purchases.total'] - $_SESSION['purchases'][$good->id]['sum'];

    }

}