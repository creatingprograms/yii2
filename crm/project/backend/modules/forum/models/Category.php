<?php

namespace backend\modules\forum\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\modules\forum\models\Infoblock;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $sub_category
 * @property string $slug
 * @property string $type
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload_image;
    
    public function getRecord()
    {
        return $this->hasMany(Record::className(), ['id' => 'category_id']);
    }
    
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'type', 'imageFile'], 'string', 'max' => 255],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['sub_category'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'upload_image' => 'Изображение',
            'sub_category' => 'Главная категория',
            'type' => 'Тип отображения записей',
            'slug' => 'Ссылка',
        ];
    }
    
    public function attribut()
    {
        if ($this->validate() && $this->sub_category != '') {
            $this->sub_category = implode(',', $this->sub_category);
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
}