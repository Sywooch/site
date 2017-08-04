<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 20.06.2017
 * Time: 20:38
 */

namespace app\controllers;
use app\exceptions\MyException;
use app\exceptions\NotFoundException;
use app\models\Cart;
use app\models\OrderItems;
use app\models\Order;
use app\models\UserCart;
use app\modules\admin\models\Goods;
use function foo\func;
use Yii;

use yii\web\Controller;
use app\models\Card;

class CardController extends Controller
{


    public function actionAdd()
    {

        $session = Yii::$app->session;
        $session->open();
        $id = Yii::$app->request->get('id');
        $good = Goods::findById($id);
        $cart = new UserCart();
        $goods = $cart->addToCard($good);
        $total = array_reduce($goods, $cart->calcTotal());

        return $this->renderPartial('add', ['goods' =>$goods, 'total' => $total]);

    }
    public function actionError(){
        return $this->render('error');
    }

    public function actionShow(){

        $session = Yii::$app->session;
        $session->open();
        $goods = Cart::find()->where(['user_id'=>$session['uniqid']])->all();
        $userCart = new UserCart();
        $total = array_reduce($goods, $userCart->calcTotal());
        $total_qty = array_reduce($goods, $userCart->calcTotalQty());
        return $this->render('show', ['goods' => $goods, 'total' => $total, 'total_qty' =>$total_qty]);
    }
    protected function saveOrderItems($card, $order_id ){
        foreach($card as $id=>$item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $item['product_id'];
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price']*$item['qty'];
            $order_items->save();
        }
    }


    public function actionDelete(){

        $session = Yii::$app->session;
        $session->open();
        try {
            $product = Cart::findById(['id' => $_POST['key']]);
        }
        catch (NotFoundException $e) {
            return $this->renderPartial('error', ['exception' => $e]);
        }
        $product->delete();
        $goods = Cart::find()->where(['user_id' => $session['uniqid']])->indexBy('id')->all();
        return $this->renderPartial($_POST['page'], ['goods' => $goods]);
        }
    public function actionClear()
    {
        if(!isset($_GET['show'])){
            $this->layout = false;
        }
            $cart = new UserCart();
            $mes = $cart->clearBasket();


        return $this->render('show', ['goods' => $mes]);
    }

    public function actionEdit()
    {

        $session = Yii::$app->session;
        $session->open();
        $id = $_POST['id'];
        try {
            $cart = Cart::findById($id);
        }
        catch (NotFoundException $e){
            return $this->render('error', ['exception' => $e]);
        }
            if ($_POST['action'] == 1) {
            $cart->qty++;
            $cart->save();
        } elseif ($_POST['action'] == -1) {
            $cart->qty--;
            $cart->save();
        }
        $goods = Cart::find()->where(['user_id' => $session['uniqid']])->all();

        $total = new UserCart();
        
        $total = array_reduce($goods, $total->calcTotal());

        return $this->renderPartial($_POST['page'], ['goods' => $goods, 'total' => $total]);


    }
    public function actionPackage(){

        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        $userCart = new UserCart();
        $goods = Cart::find()->where(['user_id' => $session['uniqid']])->indexBy('id')->all();
        $total = array_reduce($goods, $userCart->calcTotal());
        $total_qty = array_reduce($goods, $userCart->calcTotalQty());
        if($order->load(Yii::$app->request->post())){
            $order->qty = $total_qty;
            $order->sum = $total;
            if($order->save()){

                $this->saveOrderItems($goods, $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с вами');
                Yii::$app->mailer->compose('order', ['goods'=>$goods, 'total' => $total, 'total_qty' =>$total_qty])
                    ->setFrom(['vfresh65@gmail.com'=>'net-shop'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();
                $userCart->clearBasket();
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('package', ['goods' => $goods, 'order'=>$order, 'total' => $total, 'total_qty' =>$total_qty]);
    }

}