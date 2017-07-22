<?php

namespace app\components;
use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{

    public function init()
    {
        parent::init();

    }
    public function run()
    {
       $cats=Category::find()->indexBy('id')->all();
       return $this->render('menu',['cats'=>$cats]);
    }

}