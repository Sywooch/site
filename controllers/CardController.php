<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 20.06.2017
 * Time: 20:38
 */

namespace app\controllers;

use app\exceptions\NotFoundException;
use app\models\Cart;
use app\models\Good;
use app\models\Order;
use app\models\OrderItem;
use app\services\CartService;
use Yii;
use yii\base\Module;
use yii\db\Expression;
use yii\web\Controller;

class CardController extends Controller
{

    /**
     * @var CartService
     */
    private $cartService;

    public function __construct($id, Module $module, CartService $cartService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cartService = $cartService;
    }


    public function actionAdd()
    {

        $session = Yii::$app->session;
        $session->open();
        $id    = Yii::$app->request->get('id');
        $good  = Good::findById($id);
        $goods = $this->cartService->addToCard($good);
        $total = array_reduce($goods, $this->cartService->calcTotal());

        return $this->renderPartial('add', ['goods' => $goods, 'total' => $total]);

    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $goods     = Cart::find()->where(['user_id' => $session['uniqid']])->all();
        $total     = array_reduce($goods, $this->cartService->calcTotal());
        $total_qty = array_reduce($goods, $this->cartService->calcTotalQty());

        return $this->render('show', ['goods' => $goods, 'total' => $total, 'total_qty' => $total_qty]);
    }

    protected function saveOrderItems($card, $order_id)
    {
        foreach ($card as $id => $item) {
            $order_items             = new OrderItem();
            $order_items->order_id   = $order_id;
            $order_items->product_id = $item['product_id'];
            $order_items->name       = $item['name'];
            $order_items->price      = $item['price'];
            $order_items->qty_item   = $item['qty'];
            $order_items->sum_item   = $item['price'] * $item['qty'];
            $order_items->save();
        }
    }


    public function actionDelete()
    {
        $session = Yii::$app->session;
        $session->open();
        try {
            $product = Cart::findById(['id' => $_POST['key']]);
        } catch (NotFoundException $e) {
            return $this->renderPartial('error', ['exception' => $e]);
        }
        $product->delete();
        $goods = Cart::find()->where(['user_id' => $session['uniqid']])->indexBy('id')->all();

        return $this->renderPartial($_POST['page'], ['goods' => $goods]);
    }

    public function actionClear()
    {
        if (!isset($_GET['show'])) {
            $this->layout = false;
        }
        $mes = $this->cartService->clearBasket();

        return $this->render('show', ['goods' => $mes]);
    }

    public function actionEdit()
    {
        $session = Yii::$app->session;
        $session->open();
        $id = $_POST['id'];
        try {
            $cart = Cart::findById($id);
        } catch (NotFoundException $e) {
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

        $total = array_reduce($goods, $this->cartService->calcTotal());

        return $this->renderPartial($_POST['page'], ['goods' => $goods, 'total' => $total]);
    }

    public function actionPackage()
    {
        $session = Yii::$app->session;
        $session->open();
        $order     = new Order();
        $goods     = Cart::find()->where(['user_id' => $session['uniqid']])->all();
        $total     = array_reduce($goods, $this->cartService->calcTotal());
        $total_qty = array_reduce($goods, $this->cartService->calcTotalQty());
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $total_qty;
            $order->sum = $total;
            $order->created_at = new Expression('now()');
            $order->updated_at = new Expression('now()');
            if ($order->save()) {

                $this->saveOrderItems($goods, $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с вами');
                Yii::$app->mailer->compose('order', ['goods' => $goods, 'total' => $total, 'total_qty' => $total_qty])
                                 ->setFrom(['vfresh65@gmail.com' => 'net-shop'])
                                 ->setTo($order->email)
                                 ->setSubject('Заказ')
                                 ->send();
                $this->cartService->clearBasket();

                return $this->refresh();
            } else {
                debug($order);
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('package', ['goods' => $goods, 'order' => $order, 'total' => $total, 'total_qty' => $total_qty]);
    }

}