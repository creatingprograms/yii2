<?php

namespace backend\modules\forum\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\modules\forum\models\Infoblock;

/**
 * This is the model class for table "infoblock_item".
 *
 * @property int $id
 * @property int $infoblock_id
 * @property string $title
 * @property string $anons
 * @property string $imageFile
 * @property string $allFile
 * @property string $description
 */
class InfoblockItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $imageFiles;
    public $upload_image;
    
    
    public function getInfoblock()
    {
        return $this->hasMany(Infoblock::className(), ['id' => 'infoblock_id']);
    }
    
    public static function tableName()
    {
        return 'infoblock_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['infoblock_id'], 'integer'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['anons', 'imageFile', 'allFile', 'description'], 'string'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg, png, jpg, pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'infoblock_id' => 'Инфоблок',
            'title' => 'Заголовок',
            'anons' => 'Анонс',
            'imageFile' => 'Изображение',
            'upload_image' => 'Изображение',
            'allFile' => 'Файлы',
            'imageFiles' => 'Файлы',
            'description' => 'Описание',
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
