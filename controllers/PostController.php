<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 07.06.2017
 * Time: 22:25
 */

namespace app\controllers;

use app\exceptions\NotFoundException;
use app\models\Good;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex()
    {
        $var = 'стартовая страница';

        return $this->render('index', ['var' => $var]);
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
        $query                = Good::find();
        $countQuery           = clone $query;
        $pages                = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $pages->pageSizeParam = false;
        $goods                = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('catalog', ['goods' => $goods, 'pages' => $pages]);
    }


    public function actionDeliviry()
    {
        return $this->render('deliviry');
    }

    public function actionView()
    {
        $good = Good::findById($_GET['id']);

        return $this->render('view', ['good' => $good]);
    }

}