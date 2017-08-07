<?php
namespace app\controllers\actions\site;
use app\exceptions\NotFoundException;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: mert
 * Date: 05.08.17
 * Time: 16:11
 */
class ErrorAction extends \yii\base\Action
{
    public function run()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception instanceof NotFoundException) { // todo add another errors and HTTP codes
                return $this->controller->render('error', ['exception' => $exception]);
            }
            if($exception instanceof NotFoundHttpException){
                return $this->controller->render('error', ['exception' => $exception]);
            }
        }
    }
}