<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 02.07.2017
 * Time: 16:21
 */

namespace app\models;

use app\models\Good;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    public static function tableName()
    {
        return 'categories';
    }
    public function getGood(){
        return $this->hasMany(Good::className(), ['cat'=>'id']);
    }
}