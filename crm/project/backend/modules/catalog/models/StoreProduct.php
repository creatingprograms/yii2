<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use DateTime;
use DateTimeZone;
use backend\models\Review;

/**
 * This is the model class for table "store_product".
 *
 * @property int $id
 * @property int $producer_id
 * @property int $type
 * @property int $category_id
 * @property string $sku
 * @property string $title
 * @property string $slug
 * @property string $price
 * @property string $discount_price
 * @property string $discount
 * @property string $short_description
 * @property string $description
 * @property string $status
 * @property string $imageFile
 * @property string $allFile
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $parent_id
 * @property string $position
 * @property int $infoblock_id
 * @property string $create_time
 * @property string $update_time
 * @property int $user_id
 */
class StoreProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public $upload_image;
    public $imageFiles;
    public $image_prod;
    public $price;
    public $value_filtr;
    public $percent;
	public $attr;
	public $product;
    
    public function getStoreCategory()
    {
        return $this->hasMany(StoreCategory::className(), ['category_id' => 'id']);
    }
    public function getReview()
    {
        return $this->hasMany(Review::className(), ['id' => 'product_id']);
    }
    
    public function getStoreProducer()
    {
        return $this->hasMany(StoreProducer::className(), ['producer_id' => 'id']);
    }
    
    public function getInfoblock()
    {
        return $this->hasMany(Infoblock::className(), ['id' => 'infoblock_id'])->viaTable('pageblock', ['record_id' => 'id']);
    }
    
    public function getStoreAttribute()
    {
        return $this->hasMany(StoreAttribute::className(), ['id' => 'attribute_id'])
            ->viaTable('store_attribute_value', ['product_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'store_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producer_id', 'type', 'category_id', 'infoblock_id', 'user_id'], 'integer'],
            [['short_description', 'description', 'imageFile', 'allFile', 'meta_title', 'meta_keywords', 'meta_description', 'parent_id'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['create_time', 'update_time'], 'date', 'format' => 'yyyy-M-d H:m:s'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['sku', 'title', 'slug', 'price', 'discount_price', 'discount', 'status', 'position'], 'string', 'max' => 255],
			[['slug'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producer_id' => 'Производитель',
            'type' => 'Упаковка',
            'category_id' => 'Категория',
            'sku' => 'Артикул',
            'title' => 'Заголовок',
            'slug' => 'Ссылка',
            'price' => 'Цена',
            'discount_price' => 'Цена от',
            'discount' => 'Скидка %',
            'percent' => 'Скидка %',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
            'value_filtr' => 'Значение',
            'status' => 'Статус',
            'imageFile' => 'Изображение',
            'upload_image' => 'Изображение',
            'allFile' => 'Галерея',
            'imageFiles' => 'Галерея',
            'meta_title' => 'Заголовок СЕО',
            'meta_keywords' => 'Ключевые слова',
            'meta_description' => 'Описание СЕО',
            'parent_id' => 'Parent ID',
            'position' => 'Позиция',
            'infoblock_id' => 'Инфоблоки',
            'create_time' => 'Время создания',
            'update_time' => 'Время обновления',
            'user_id' => 'Пользователь',
            'attr' => 'Выберите тип фильтра',
            'image_prod' => 'Изображение',
            'user_id' => 'Пользователь',
        ];
    }
    public function getSmallImage() {
        if($this->imageFile){
            $path = '/uploads/images/50x50/'.$this->imageFile;
        }else{
            $path = '/uploads/images/no_image.svg';
        }
        return $path;
    }
    
    public function upload()
    {
        $files = [];
        $files1 = [];
        if ($this->validate()) {
            if(!empty($this->imageFiles)){
                foreach ($this->imageFiles as $file) {
                    $filename=Yii::$app->getSecurity()->generateRandomString(15);
                    $convertedText = mb_convert_encoding($file->baseName, 'UTF8', mb_detect_encoding($file->baseName));
                    $file->saveAs('uploads/files/' . $convertedText . '.' . $file->extension);
                    $files = array_push($files1, $file->baseName . '.' . $file->extension);
                }
                $files = implode($files1, ',');

                $this->allFile = $files;
            }else{
                $this->allFile=$this->allFile;
            }
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
                @unlink($dir.$this->imageFile);
            }
            if(file_exists($dir.'/50x50/'.$this->imageFile)){
                @unlink($dir.'/50x50/'.$this->imageFile);
            }
            if(file_exists($dir.'/800x/'.$this->imageFile)){
                @unlink($dir.'/800x/'.$this->imageFile);
            }
            $this->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
            $file->saveAs($dir.$this->imageFile);
            $imag = Yii::$app->image->load($dir.$this->imageFile);
            $imag->background('#fff',0);
            $imag->resize('50', '50', Yii\image\drivers\Image::INVERSE);
            $imag->crop('50', '50');
            $imag->save($dir.'/50x50/'.$this->imageFile, 90);
            $imag = Yii::$app->image->load($dir.$this->imageFile);
            $imag->background('#fff',0);
            $imag->resize('800', null, Yii\image\drivers\Image::INVERSE);
            $imag->save($dir.'/800x/'.$this->imageFile, 90);
        }
        $time = new DateTime('now', new DateTimeZone('UTC'));
        $this->create_time = $time->format('Y-m-d H:m:s');
        
        return true;
        //return parent::beforeSave($insert);
    }
}
