<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $cat
 * @property string $cat_name
 */
class Category extends \app\base\ActiveRecord
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
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGood(){
        return $this->hasMany(Good::className(), ['cat'=>'id']);
    }
}
