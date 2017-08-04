<?php
namespace app\base;


use app\exceptions\NotFoundException;


class ActiveRecord extends \yii\db\ActiveRecord
{

    public static function findById($id){
        $result = self::findOne($id);
        if($result===null){
            throw new NotFoundException('К сожалению, этот товар отсутсвует');
        }
        return $result;

    }
}