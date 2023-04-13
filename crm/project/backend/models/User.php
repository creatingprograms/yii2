<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $phone
 * @property string $active
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
	
	
	public $password;
	public $projects;
	
	public function getProjects()
	{
		return $this->hasMany(Project::classname(), ['user_id' => 'id']);
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'phone', 'role'], 'required'],
			[['ogrn', 'inn', 'rs', 'ks', 'bik', 'bank', 'ur_address'], 'required', 'when' => function($model) {
				return $model->type == '2';
			}],
			['role', 'in', 'range' => [1, 2, 5]],
			['password', 'required', 'on'=>'create'],
            [['status', 'role', 'type', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'name', 'surname', 'patronymic', 'phone', 'active', 'projects', 'ogrn', 'inn', 'rs', 'ks', 'bik', 'bank', 'ur_address', 
			'ur_name', 'fis_passport', 'fis_vidan', 'fis_number', 'fis_registration'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Клиент',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Эл. почта',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'verification_token' => 'Verification Token',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'active' => 'Активный',
            'role' => 'Роль',
            'type' => 'Заказчик',
            'projects' => 'Выберите проект',
            'password' => 'Пароль',
            'ogrn' => 'ОГРН',
            'inn' => 'ИНН',
            'rs' => 'Расчетный счет',
            'ks' => 'Кор. счет',
            'bik' => 'БИК',
            'bank' => 'Банк',
            'ur_address' => 'Юр. адрес',
			'ur_name' => 'Наименование Юрлица',
			'fis_passport' => 'Cерия/номер паспорт',
			'fis_vidan' => 'Кем/когда выдан',
			'fis_number' => 'Код подразделения',
			'fis_registration' => 'Прописка'
        ];
    }
    public function beforeSave($insert)
    {
		$time = new DateTime('now', new DateTimeZone('UTC'));
		if(empty($this->created_at)){
			$this->created_at = strtotime($time->format('Y-m-d H:m:s'));
		}
		$this->updated_at = strtotime($time->format('Y-m-d H:m:s'));
        
        return true;
    }
	
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
