<?php
namespace app\controllers;
use app\controllers\actions\site\ErrorAction;
use yii\web\Controller;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => ErrorAction::class,
        ];
    }
}
