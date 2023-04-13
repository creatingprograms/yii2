<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;
use yii\web\UploadedFile;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property int $menu_id
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }
	
    public $upload_doc;
	public $doc_file;
	public $unic_file;
	
	public function getProjects()
	{
		return $this->hasOne(Project::className(), ['project_id'=>'id']);
	}
	public function getDocuments() {
		return $this->hasOne(Document::className(), ['id'=>'document_id']);
	} 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'sub_id', 'manager_id', 'document_id', 'type'], 'integer'],
			[['title'], 'required'],
			[['project_id'], 'required', 'on'=>'create'],
            [['unic_file'], 'default', 'value' => '0'],
            [['status'], 'string'],
            [['created_at', 'updated_at, startdate_at'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Событие',
            'description' => 'Описание',
            'project_id' => 'Договор',
            'user_id' => 'Клиент',
            'sub_id' => 'Субподрядчик',
            'manager_id' => 'Менеджер',
            'document_id' => 'Документ',
            'status' => 'Статус',
            'type' => 'Требуется согласовать',
            'comment' => 'Комментария',
            'created_at' => 'Дата окончания',
            'updated_at' => 'Обновлено',
            'startdate_at' => 'Дата начала',
			'upload_doc' => 'Документ',
			'unic_file' => 'Требуется документ'
        ];
    }
    public function beforeSave($insert)
    {
		$time = new DateTime('now', new DateTimeZone('UTC'));
		if(empty($this->created_at)){
			$this->created_at = strtotime($time->format('Y-m-d'));
		}else if(strlen((int)$this->created_at) == 4){
			$this->created_at = strtotime($this->created_at);
		}
		$this->updated_at = strtotime($time->format('Y-m-d H:m:s'));
		
        if($file = UploadedFile::getInstance($this, 'document_id')){
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
