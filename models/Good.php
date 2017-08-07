<?php

namespace app\models;

use app\base\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $title
 * @property string $discr
 * @property integer $price
 * @property string $cat
 * @property string $img
 *
 */
class Good extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;
    public $gallery;
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'cat',], 'required'],
            [['discr'], 'string'],
            [['price'], 'integer'],
            [['title', 'img'], 'string', 'max' => 255],
            [['cat'], 'string', 'max' => 50],
            [['title'], 'unique'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'title'   => 'Название',
            'discr'   => 'Discr',
            'price'   => 'Цена',
            'cat'     => 'Категория',
            'image'   => 'изображение',
            'gallery' => 'Галерея',
        ];
    }
    /*
     *@method Image[] getGallery()
     *@property Image $image
     *
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);

            return true;
        }

        return false;
    }

    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach ($this->gallery as $photo) {
                $path = 'upload/store/' . $photo->baseName . '.' . $photo->extension;
                $photo->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     * @return GoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodQuery(get_called_class());
    }
}
