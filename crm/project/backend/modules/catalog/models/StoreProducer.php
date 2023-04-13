<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\modules\catalog\models\StoreProducerItem;
use backend\models\Slideritem;

/**
 * This is the model class for table "store_producer".
 *
 * @property int $id
 * @property string $title
 * @property string $anons
 * @property string $slug
 * @property string $imageFile
 * @property string $allFile
 * @property string $short_description
 * @property string $description
 * @property string $status
 * @property string $sort
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class StoreProducer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $imageFiles;
    public $upload_image;
    
    public function getStoreProducerItem()
    {
        return $this->hasMany(StoreProducerItem::className(), ['producer_id' => 'id']);
    }
    
    public function getSliderItem()
    {
        return $this->hasMany(Slideritem::className(), ['producer_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'store_producer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile', 'allFile', 'short_description', 'description', 'meta_title', 'meta_keywords', 'meta_description'], 'string'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg, png, jpg, pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['title', 'anons', 'slug', 'status', 'sort'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'anons' => 'Анонс',
            'slug' => 'Ссылка',
            'imageFile' => 'Главное изображение',
            'upload_image' => 'Главное изображение',
            'allFile' => 'Изображения',
            'imageFiles' => 'Изображения',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
            'status' => 'Статус',
            'sort' => 'Сортировка',
            'meta_title' => 'Загловок СЕО',
            'meta_keywords' => 'Ключевые слова',
            'meta_description' => 'Описание СЕО',
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
    
    public function upload()
    {
        $files = [];
        $files1 = [];
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $filename=Yii::$app->getSecurity()->generateRandomString(15);
                // echo $filename;
                $convertedText = mb_convert_encoding($file->baseName, 'UTF8', mb_detect_encoding($file->baseName));
                $file->saveAs('uploads/images/' . $convertedText . '.' . $file->extension);
                $files = array_push($files1, $file->baseName . '.' . $file->extension);
            }
            $files = implode($files1, ',');
            
            $this->allFile = $files;
            //die($this->allFile);
            return true;
        } else {
            return false;
        }
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
