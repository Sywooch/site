<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $module
 * @property integer $static
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_title
 * @property string $text
 */
class Page extends \app\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'meta_description', 'meta_keywords', 'meta_title', 'text'], 'required'],
            [['static'], 'integer'],
            [['meta_description', 'meta_keywords', 'meta_title', 'text'], 'string'],
            [['module'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
