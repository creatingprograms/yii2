<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property int $manager_id
 * @property int $status
 * @property int $status_men
 * @property int $status_ad
 * @property int $status_us
 * @property int $created_at
 * @property int $updated_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['user_id', 'manager_id', 'event_id', 'status', 'status_men', 'status_ad', 'status_us', 'created_at', 'updated_at'], 'integer'],
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
            'title' => 'Событие',
            'description' => 'Описание',
            'user_id' => 'Клиент',
            'manager_id' => 'Менеджер',
            'status' => 'Сьтатус',
            'status_men' => 'Статус менеджера',
            'status_ad' => 'Статус админа',
            'status_us' => 'Статус клиента',
			'event_id' => 'Событие',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
