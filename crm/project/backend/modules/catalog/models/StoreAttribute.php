<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\modules\catalog\models\StoreAttributeGroup;
use backend\modules\catalog\models\StoreAttributeValue;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "store_attribute".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $type
 * @property string $sort
 * @property string $slug
 * @property string $description
 * @property int $group_id
 */
class StoreAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    
    public $upload_image;
    public $upload_image1;
    
    public function getStoreAttributeGroup()
    {
        return $this->hasMany(StoreAttributeGroup::className(), ['id' => 'group_id']);
    }
    
    public function getStoreAttributeValue()
    {
        return $this->hasMany(StoreAttributeValue::className(), ['attribute_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'store_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'imageFile', 'param_icon', 'price', 'discount'], 'string'],
            [['group_id'], 'integer'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['name', 'title', 'type', 'sort', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'title' => 'Заголовок',
            'type' => 'Тип',
            'sort' => 'Сортировка',
            'slug' => 'Алиас',
            'description' => 'Описание',
            'group_id' => 'Фильтр',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'imageFile' => 'Изображение товара',
            'param_icon' => 'Иконка атрибута',
            'upload_image1' => 'Изображение товара',
            'upload_image' => 'Иконка атрибута',
        ];
    }
    
    public function getSmallImage() {
        if($this->param_icon){
            $path = '/uploads/images/'.$this->param_icon;
        }else{
            $path = '/uploads/images/default/no_image.svg';
        }
        return $path;
    }
}
