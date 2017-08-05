<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 02.07.2017
 * Time: 15:56
 */

namespace app\controllers;
use app\models\Good;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionView(){
        $page=Yii::$app->request->get('name');
        $cat=Yii::$app->request->get('cat');
        $goods=Good::find()->where(['cat'=>$cat])->all();
        return $this->render($page, ['goods'=>$goods]);
    }

}