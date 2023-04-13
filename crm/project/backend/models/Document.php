<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;
use yii\web\UploadedFile;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property int $project_id
 * @property int $type_id
 * @property string $create_time
 * @property string $update_time
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    public $upload_doc;
	public $doc_file;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'event_id', 'type_id'], 'integer'],
            [['created_at', 'updated_ate'], 'safe'],
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название документа',
            'link' => 'Link',
            'project_id' => 'Объект',
			'event_id' => 'Событие объекта',
            'type_id' => 'Тип документа',
            'created_at' => 'Создан',
            'updated_ate' => 'Обновлен',
        ];
    }
    public function beforeSave($insert)
    {
		$time = new DateTime('now', new DateTimeZone('UTC'));
		if(empty($this->created_at)){
			$this->created_at = strtotime($time->format('Y-m-d H:m:s'));
		}else if(strlen((int)$this->created_at) == 4){
			$this->created_at = strtotime($this->created_at);
		}
		$this->updated_at = strtotime($time->format('Y-m-d H:m:s'));
		
        if($file = UploadedFile::getInstance($this, 'link')){
            $dir = Yii::getAlias('@images').'/documrnts/';
            //die($dir);
            if(file_exists($dir.$this->upload_doc)){
                @unlink($dir.$this->upload_doc);
            }
            $this->upload_doc = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
            $file->saveAs($dir.$this->doc_file);
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
        return true;
    }
}
