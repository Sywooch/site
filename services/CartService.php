<?php
/**
 * Created by PhpStorm.
 * User: mert
 * Date: 05.08.17
 * Time: 15:37
 */

namespace app\services;


use app\models\Cart;
use app\models\Good;
use Yii;
use yii\base\Component;

class CartService extends Component
{
    /**
     * @param Good $good
     * @return Cart|Cart[]|static
     */
    public function addToCard(Good $good)
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
            $cart             = new Cart;
            $cart->user_id    = $session['uniqid'];
            $cart->product_id = $good->id;
            $cart->qty        = 1;
            $cart->name       = $good->title;
            $cart->price      = $good->price;
            $cart->img        = $good->getImage()->getUrl('100x');
            $cart->save();
        }

        $cart = Cart::find()->where(['user_id' => $session['uniqid']])->all();

        return $cart;
    }

    public function clearBasket()
    {
        $session = Yii::$app->session;
        Cart::deleteAll(['user_id' => $session['uniqid']]);
    }

    /**
     * @return \Closure
     */
    public function calcTotal()
    {
        $calcTotal = function ($total, $value) {
            $total += $value->price * $value->qty;

            return $total;
        };

        return $calcTotal;
    }

    /**
     * @return \Closure
     */
    public function calcTotalQty()
    {
        $calcTotalQty = function ($total, $value) {
            $total += $value->qty;

            return $total;
        };

        return $calcTotalQty;
    }

}