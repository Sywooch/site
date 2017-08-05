<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $filePath
 * @property integer $itemId
 * @property integer $isMain
 * @property string $modelName
 * @property string $urlAlias
 * @property string $name
 */
class Image extends \app\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filePath', 'itemId', 'isMain', 'modelName', 'urlAlias', 'name'], 'required'],
            [['itemId', 'isMain'], 'integer'],
            [['filePath', 'urlAlias', 'name'], 'string', 'max' => 255],
            [['modelName'], 'string', 'max' => 150],
        ];
    }


    /**
     * @inheritdoc
     * @return ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImageQuery(get_called_class());
    }
}
