<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 20.06.2017
 * Time: 20:38
 */

namespace app\controllers;
use app\models\OrderItems;
use app\models\Order;
use app\modules\admin\models\Goods;
use Yii;

use yii\web\Controller;
use app\models\Card;

class CardController extends Controller
{

    //public $enableCsrfValidation = false;
    public function actionIndex(){

        $id=Yii::$app->request->get('id');
        $good=Goods::findOne($id);
        $session=Yii::$app->session;
        $session->open();
        if(!isset($_SESSION['purchases']['count'])) $_SESSION['purchases']['count']=0;
       $_SESSION['purchases'][]=$good;


       //$session->destroy();

        return $this->render('index', ['goods'=>$_SESSION['purchases']]);
    }
    public function actionAdd(){
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();

        if(isset($_POST['clear'])) {
            $session->destroy();
            return $this->render('clear');
        }else {
            $id = Yii::$app->request->get('id');
            $good = Goods::findOne($id);
            $card = new Card();
            $card->addToCard($good);


           return $this->render('add', ['goods' => $_SESSION['purchases']]);
        }
    }

    public function actionShow(){

        $session = Yii::$app->session;
        $session->open();


        return $this->render('show', ['goods' => $_SESSION['purchases']]);
    }
    protected function saveOrderItems($card, $order_id){
        foreach($card as $id=>$item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['sum'];
            $order_items->save();
        }
    }
    public function actionDelete(){
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        $good = Goods::findOne($_POST['key']);
        $card = new Card();
        $card->reCount($good);
        unset($_SESSION['purchases'][$_POST['key']]);
        return $this->render($_POST['page'], ['goods' => $_SESSION['purchases']]);
        }
    public function actionClear()
    {
        if (Yii::$app->request->get('clear')) {
            $session = Yii::$app->session;
            $session->open();
            $session->destroy();

        }
        return $this->render('show', ['goods' => $_SESSION['purchases']]);
    }
    public function actionEdit()
    {

        $session = Yii::$app->session;
        $session->open();
        $id = $_POST['id'];
        $this->layout = false;
        if ($_POST['action']=='plus') {
            $_SESSION['purchases'][$id]['qty']++;
        }elseif ($_POST['action']=='minus'){
                $_SESSION['purchases'][$id]['qty']--;
        }
        $_SESSION['purchases'][$id]['sum'] = $_SESSION['purchases'][$id]['price']*$_SESSION['purchases'][$id]['qty'];
        $good = Goods::findOne($id);
        $card = new Card();
        $card->countUp($good, $_POST['action']);
        return $this->render($_POST['page'], ['goods'=>$_SESSION['purchases']]);


    }
    public function actionPackage(){

        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        if($order->load(Yii::$app->request->post())){
            $order->qty = $_SESSION['purchases.qty'];
            $order->sum = $_SESSION['purchases.total'];
            if($order->save()){
                $this->saveOrderItems($_SESSION['purchases'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с вами');
                Yii::$app->mailer->compose('order', ['goods'=>$_SESSION['purchases']])
                    ->setFrom(['vfresh65@gmail.com'=>'net-shop'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();
                unset($_SESSION['purchases']);
                unset($_SESSION['purchases.qty']);
                unset($_SESSION['purchases.total']);

                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('package', ['goods' => $_SESSION['purchases'], 'order'=>$order]);
    }

}