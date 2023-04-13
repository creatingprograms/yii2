<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\modules\forum\models\Infoblock;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "store_category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string $imageFile
 * @property string $short_description
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $status
 * @property string $sort
 * @property string $type
 */
class StoreCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload_image;
	
    public function getParent()
	{
		return $this->hasOne(StoreCategory::className(), ['id' => 'parent_id']);
	}
	
    public function getStoreProduct()
    {
        return $this->hasMany(StoreProduct::className(), ['id' => 'category_id']);
    }
    
    public static function tableName()
    {
        return 'store_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['imageFile', 'short_description', 'description', 'meta_title', 'meta_description', 'meta_keywords'], 'string'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['title', 'slug', 'status', 'sort', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Главная категория',
            'title' => 'Заголовок',
            'slug' => 'Ссылка',
            'imageFile' => 'Изображение',
            'upload_image' => 'Изображение',
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'meta_title' => 'Заголовок СЕО',
            'meta_description' => 'Описание СЕО',
            'meta_keywords' => 'Ключевые слова',
            'status' => 'Статус',
            'sort' => 'Сортировка',
            'type' => 'Тип',
        ];
    }
    
    public function attribut()
    {
        if ($this->validate() && $this->parent_id != '') {
            //$this->parent_id = implode(',', $this->parent_id);
            $this->parent_id = $this->parent_id;
        }
        return true;
    }
    
    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'imageFile')){
            $dir = Yii::getAlias('@images').'/images/';
            if(file_exists($dir.$this->imageFile)){
                unlink($dir.$this->imageFile);
            }
            $this->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
            $file->saveAs($dir.$this->imageFile);
            //die($dir.$this->imageFile);
            
            $time = new DateTime('now', new DateTimeZone('UTC'));
            $this->created_at = $time->format('Y-m-d H:m:s');
        }
        return true;
    }
	
	public function getParentName()
	{
		$parent = $this->parent_id;
		//die($this);
		return $parent ? $parent->title : '';
	}
}
