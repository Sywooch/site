<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 10.06.2017
 * Time: 16:00
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class GuestForm extends ActiveRecord
{

    public function attributeLabels()
    {
       return [
           'name'=>'Имя',
           'email'=>'E-mail'
       ];
    }

    public static function tableName()
    {
        return 'test';
    }

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],

        ];
    }

}