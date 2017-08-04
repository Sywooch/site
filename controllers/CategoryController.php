<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 02.07.2017
 * Time: 15:56
 */

namespace app\controllers;
use app\models\Category;
use app\models\Good;
use app\modules\admin\models\Goods;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionView(){
        $page=Yii::$app->request->get('name');
        $cat=Yii::$app->request->get('cat');
        $goods=Goods::find()->where(['cat'=>$cat])->all();
        return $this->render($page, ['goods'=>$goods]);


    }

}