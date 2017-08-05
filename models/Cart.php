<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $product_id
 * @property integer $qty
 * @property string $name
 * @property integer $price
 * @property string $img
 */
class Cart extends \app\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'qty', 'name', 'price', 'img'], 'required'],
            [['product_id', 'qty', 'price'], 'integer'],
            [['user_id', 'name', 'img'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     * @return CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CartQuery(get_called_class());
    }



}
