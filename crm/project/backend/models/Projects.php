<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $user_id
 * @property int $manager_id
 * @property string $area
 * @property string $type
 * @property int $status_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }
	public function getUser() {
		return $this->hasOne(User::className(), ['id'=>'user_id']);
	} 
	
	public function getManager() {
		return $this->hasOne(User::className(), ['id'=>'manager_id']);
	} 
	
	public function getStatus()
	{
		return $this->hasMany(Status::classname(), ['id' => 'status_id']);
	}
	public function getEvents()
	{
		return $this->hasMany(Event::classname(), ['project_id' => 'id']);
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status_id', 'user_id', 'manager_id'], 'required'],
            [['address', 'description'], 'string'],
            [['user_id', 'manager_id', 'status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'area', 'type', 'number'], 'string', 'max' => 255],
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
            'address' => 'Адрес',
            'user_id' => 'Клиент',
            'manager_id' => 'Менеджер',
            'area' => 'Площадь',
            'type' => 'Тип Договора',
            'status_id' => 'Статус',
            'description' => 'Описание',
            'created_at' => 'Добавлен',
            'updated_at' => 'Обновлен',
			'number' => '№ Договора',
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
        return true;
    }
}
