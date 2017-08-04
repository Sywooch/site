<?php

namespace app\modules\admin\models;

use Yii;
use app\base\ActiveRecord;
/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $cat
 * @property string $cat_name
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat', 'cat_name'], 'required'],
            [['cat'], 'string', 'max' => 50],
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat' => 'Категория',
            'cat_name' => 'Перевод',
        ];
    }
}
