<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\modules\catalog\models\StoreProducer;

/**
 * This is the model class for table "store_producer_item".
 *
 * @property int $id
 * @property int $producer_id
 * @property string $title
 * @property string $anons
 * @property string $slug
 * @property string $imageFile
 * @property string $description
 * @property int $type
 */
class StoreProducerItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $upload_image;
    
    public function getStoreProducerItem()
    {
        return $this->hasMany(StoreProducer::className(), ['id' => 'producer_id']);
    }
    
    public static function tableName()
    {
        return 'store_producer_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producer_id', 'type'], 'integer'],
            [['imageFile', 'description'], 'string'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['title', 'anons', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producer_id' => 'Коллекция',
            'title' => 'Заголовок',
            'anons' => 'Анонс',
            'slug' => 'Ссылка',
            'imageFile' => 'Изображение',
            'description' => 'Описание',
            'type' => 'Тип',
        ];
    }
    
    public function getSmallImage() {
        if($this->imageFile){
            $path = '/uploads/images/'.$this->imageFile;
        }else{
            $path = str_replace('admin.', '', Url::home(true)).'uploads/images/no_image.svg';
        }
        return $path;
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
}
