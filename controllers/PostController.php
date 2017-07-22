<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 07.06.2017
 * Time: 22:25
 */

namespace app\controllers;

use app\modules\admin\models\Goods;
use yii\web\Controller;
use yii\data\Pagination;



class PostController extends Controller
{



    public function actionIndex()
    {

        $var = 'стартовая страница';
        return $this->render('index', compact('var'));
    }


    public function actionArticles()
    {
        return $this->render('articles');
    }

    public function actionContacts()
    {
        return $this->render('contacts');
    }

    public function actionAboutMag()
    {
        return $this->render('about-mag');
    }

    public function actionCatalog()
    {
        $query = Goods::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>5]);
        $pages->pageSizeParam = false;
        $goods = $query->offset($pages->offset)->limit($pages->limit)->all();
        //$goods = Good::find()->asArray()->all();
        return $this->render('catalog', ['goods'=>$goods,  'pages'=>$pages]);
    }


    public function actionDeliviry()
    {
        return $this->render('deliviry');
    }

    public function actionView()
    {
        $good = Goods::find()->where(['id' => $_GET['id']])->limit(1)->one();
        return $this->render('view', ['good' => $good]);
    }



}