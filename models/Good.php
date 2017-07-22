<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 11.06.2017
 * Time: 18:04
 * @property integer $id
 */

namespace app\models;

use app\models\Category;
use yii\db\ActiveRecord;


class Good extends ActiveRecord
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
        return 'goods';
    }
//    public function getCategory(){
//        return $this->hasOne(Category::className(), ['id'=>'cat']);
//    }
}