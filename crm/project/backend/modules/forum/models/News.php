<?php

namespace backend\modules\forum\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\modules\forum\models\Infoblock;
use yii\helpers\ArrayHelper;
use DateTime;
use DateTimeZone;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $imageFile
 * @property string $description
 * @property string $allFile
 * @property string $docFile
 * @property string $titleFile
 * @property string $stock
 * @property string $video
 * @property string $text
 * @property string $created_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $imageFiles;
    public $docFiles;
	public $upload_image;
    
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile', 'description', 'allFile', 'text', 'slug', 'docFile', 'titleFile', 'stock', 'video'], 'string'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['docFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'docx, xlsx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['created_at'], 'safe'],
            [['created_at'], 'date', 'format' => 'yyyy-M-d H:m:s'],
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
            'title' => 'Заголовок',
            'slug' => 'Ссылка',
            //'imageFile' => 'Изображение',
            'upload_image' => 'Изображение',
            'smallImage' => 'Изображение',
            'description' => 'Описание',
            'allFile' => 'Галерея',
            'imageFiles' => 'Галерея',
            'text' => 'Текстовый блок',
            'docFiles' => 'Документы',
            'titleFile' => 'Названия документов через запятую',
            'stock' => 'Акция',
            'video' => 'Видео',
            'created_at' => 'Дата добавления',
        ];
    }
    
    public function getSmallImage() {
        if($this->imageFile){
            $path = '/uploads/images/50x50/'.$this->imageFile;
        }else{
            $path = str_replace('admin.', '', Url::home(true)).'uploads/images/no_image.svg';
        }
        return $path;
    }
    
    public function upload()
    {
        $files = [];
        $files1 = [];
        $dir = Yii::getAlias('@images').'/images/';
        $dir1 = Yii::getAlias('@images').'/files/';
        if ($this->validate()) {
            if($this->imageFiles){
                foreach ($this->imageFiles as $file) {
                    //die($file);
                    //$filename=Yii::$app->getSecurity()->generateRandomString(15);
                    // echo $filename;
                    $convertedText = mb_convert_encoding($file->baseName, 'UTF8', mb_detect_encoding($file->baseName));
                    $file->saveAs($dir . $convertedText . '.' . $file->extension);
                    $files = array_push($files1, $convertedText . '.' . $file->extension);
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
            if(file_exists($dir.'50x50/'.$this->imageFile)){
                @unlink($dir.'50x50'.$this->imageFile);
            }
            if(file_exists($dir.'800x'.$this->imageFile)){
                @unlink($dir.'800x'.$this->imageFile);
            }
            $this->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
            $file->saveAs($dir.$this->imageFile);
            $imag = Yii::$app->image->load($dir.$this->imageFile);
            $imag->background('#fff',0);
            $imag->resize('50', '50', Yii\image\drivers\Image::INVERSE);
            $imag->crop('50', '50');
            $imag->save($dir.'50x50/'.$this->imageFile, 90);
            $imag = Yii::$app->image->load($dir.$this->imageFile);
            $imag->background('#fff',0);
            $imag->resize('800', null, Yii\image\drivers\Image::INVERSE);
            $imag->save($dir.'800x/'.$this->imageFile, 90);
        }
        $time = new DateTime('now', new DateTimeZone('UTC'));
        $this->created_at = $time->format('Y-m-d H:m:s');
        
        return true;
    }
	
    public static function NextOrPrev($currentId)
	{
		$news = News::find()->orderBy('id DESC')->all();

		foreach ($news as $i => $new) {
			if ($new->id == $currentId) {
				$next = isset($records[$i - 1]->id)?$records[$i - 1]->id:null;
				$prev = isset($records[$i + 1]->id)?$records[$i + 1]->id:null;
				break;
			}
		}
		return ['next'=>$next, 'prev'=>$prev];
	}
    
}
