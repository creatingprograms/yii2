<?php

namespace backend\modules\forum\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\models\Staticpage;
use yii\helpers\ArrayHelper;
use backend\modules\forum\models\InfoblockItem;


/**
 * This is the model class for table "infoblock".
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $allFile
 * @property string $type
 * @property string $link
 * @property string $text_link
 * @property string $indexok
 * @property string $imageFile
 * @property string $created_at
 */
class Infoblock extends \yii\db\ActiveRecord
{
    public $file;
    public $imageFiles;
    public $upload_image;
    
    public function getStaticpage()
    {
        return $this->hasOne(Staticpage::className(), ['infoblock_id' => 'id']);
    }
    
    public function getInfoblockItem()
    {
        return $this->hasOne(InfoblockItem::className(), ['infoblock_id' => 'id']);
    }
    
    public function getRecord()
    {
        return $this->hasOne(Record::className(), ['infoblock_id' => 'id']);
    }
    
    public function getPageblock()
    {
        return $this->hasOne(Pageblock::className(), ['infoblock_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'infoblock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'imageFile', 'type', 'text_link', 'indexok', 'allFile'], 'string'],
            [['upload_image', 'file'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['created_at', 'link', 'upload_image'], 'safe'],
            [['created_at'], 'date', 'format' => 'yyyy-M-d H:m:s'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg, png, jpg, pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['title', 'alias'], 'string', 'max' => 255],
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
            'alias' => 'Алиас',
            'description' => 'Описание',
            'upload_image' => 'Изображение',
            'allFile' => 'Файлы',
            'type' => 'Тип инфоблока',
            'link' => 'Ссылки',
            'text_link' => 'Наименования ссылок через запятую',
            'indexok' => 'Показывать на главной странице',
            'smallImage' => 'Изображение',
            'created_at' => 'Created At',
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
                $file->saveAs('uploads/files/' . $convertedText . '.' . $file->extension);
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
        
        if (parent::beforeSave($insert))
        {
            $files1 = [];
            $files = [];
			//$all_file = [];
            if($this->link != ''){
				//$all_file = explode(",", $this->link);
                foreach ($this->link as $file) {
                    $files = array_push($files1, $file);
                }
                $files = implode($files1, ',');
                
                $this->link = $files;
            }
        }
        return true;
    }
}