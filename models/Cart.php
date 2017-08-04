<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 26.07.2017
 * Time: 17:31
 */

namespace app\models;


use app\base\ActiveRecord;

class Cart extends ActiveRecord
{

    public static function tableName()
    {
        return 'cart';
    }
}