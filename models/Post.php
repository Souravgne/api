<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $state_id
 * @property int $category_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

     public $imageFile;
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'image', 'category_id'], 'required'],
            [['description'], 'string'],
            [['state_id', 'category_id'], 'integer'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function uploadImage()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->image = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension; // Save the file path in DB
            return true;
        }
        return false;
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'state_id' => 'State ID',
            'category_id' => 'Category ID',
        ];
    }
}
