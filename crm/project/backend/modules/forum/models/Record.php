<?php

namespace backend\modules\forum\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use DateTime;
use DateTimeZone;
/**
 * This is the model class for table "record".
 *
 * @property string $imageFile
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $infoblock_id
 * @property string $title_file
 * @property string $allFile
 * @property int $category_id
 * @property string $link
 * @property string $text_link
 * @property string $structure
 * @property string $created_at
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $file;
    public $file1;
    public $file2;
    public $file3;
    public $file4;
    public $upload_image;
    public $imageFiles;
    
    
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'id']);
    }
    
    public function getInfoblock()
    {
        return $this->hasMany(Infoblock::className(), ['id' => 'infoblock_id'])->viaTable('pageblock', ['recotd_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile', 'slug', 'description', 'text_link', 'allFile'], 'string'],
            [['created_at', 'infoblock_id', 'category_id', 'link'], 'safe'],
            [['created_at'], 'date', 'format' => 'yyyy-M-d H:m:s'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, xlsx, docx', 'maxFiles' => 10,'checkExtensionByMimeType'=>false],
            [['title', 'title_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imageFile' => 'Изображение',
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Ссылка',
            'smallImage' => 'Изображение',
            'upload_image' => 'Изображение',
            'description' => 'Описание',
            'infoblock_id' => 'Выбрать инфоблок',
            'title_file' => 'Заголовок файлов',
            'allFile' => 'Файлы',
            'imageFiles' => 'Файлы',
            'file' => 'Файлы',
            'link' => 'Ссылки на другие страницы',
            'text_link' => 'Наименования ссылок через запятую',
            'category_id' => 'Категория',
            'created_at' => 'Дата добавления',
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
            if(!empty($this->file)){
                foreach ($this->file as $file) {
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
        $this->created_at = $time->format('Y-m-d H:m:s');
        
        //die($this->id);
        if (parent::beforeSave($insert))
        {
            $pageblocks = [];
            $delblocks = [];
            if($this->infoblock_id){
                $pageblocks = $this->infoblock_id;
            }else {
                $this->infoblock_id = '2';
            }
            
            $delblocks = Pageblock::find()->where(['record_id' => $this->id])->all();
            foreach ($delblocks as $delblock){
                $delblock->delete();
            }
            
            if($this->infoblock_id and $pageblocks == '1' or empty($pageblocks)) {
                foreach ($pageblocks as $pageblock){
                    
                    $block_id = Pageblock::find()->where(['record_id' => $this->id])->andWhere(['infoblock_id' => $pageblock])->one();
                    if(!$block_id) {
                        $block = new Pageblock();
                        $block->record_id = $this->id;
                        $block->infoblock_id = $pageblock;
                        $block->save();
                    }
                }
            }
            
            $files1 = [];
            $files = [];
            if($this->link != ''){
            foreach ($this->link as $file) {
                $files = array_push($files1, $file);
            }
            $files = implode($files1, ',');
            
            $this->link = $files;
            }
            //$this->infoblock_id = implode(",",$this->infoblock_id);
        }
        return true;
        //return parent::beforeSave($insert);
    }
}
