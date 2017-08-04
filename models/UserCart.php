<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 26.07.2017
 * Time: 17:35
 */

namespace app\models;


use app\modules\admin\models\Goods;
use yii\base\Model;
use Yii;
use app\models\Cart;

class UserCart extends Model
{


    public function addToCard($good)
    {
        $session = Yii::$app->session;
        $session->open();
        if (!isset($session['uniqid'])) {
            $session['uniqid'] = uniqid('user_', false);
        }
        if ($cart = Cart::findOne(['user_id' => $session['uniqid'], 'product_id' => $good->id])) {
            $cart->qty++;
            $cart->save();

        } else {
            $cart = new Cart;
            $cart->user_id = $session['uniqid'];
            $cart->product_id = $good->id;
            $cart->qty = 1;
            $cart->name = $good->title;
            $cart->price = $good->price;
            $cart->img = $good->getImage()->getUrl('100x');
            $cart->save();
        }

        $cart = Cart::find()->where(['user_id'=>$session['uniqid']])->all();
        return $cart;
    }
    public function clearBasket()
    {
        $session = Yii::$app->session;
        Cart::deleteAll(['user_id' => $session['uniqid']]);
        return null;


    }

    public function calcTotal(){
       $calcTotal =  function ($total, $value){
            $total += $value->price*$value->qty;
            return $total;
        };
        return $calcTotal;
    }
    public function calcTotalQty(){
        $calcTotalQty = function($total, $value){
            $total += $value->qty;
            return $total;
        };
        return$calcTotalQty;
    }


}