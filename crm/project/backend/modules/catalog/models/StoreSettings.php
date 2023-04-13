<?php

namespace backend\modules\catalog\models;

use Yii;
use DateTime;
use DateTimeZone;




/**
 * This is the model class for table "store_settings".
 *
 * @property int $id
 * @property string $module_id
 * @property string $param_name
 * @property string $param_value
 * @property string $create_time
 * @property string $update_time
 * @property int $user_id
 * @property int $type
 */
class StoreSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload_image;
    
    public static function tableName()
    {
        return 'store_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['user_id', 'type'], 'integer'],
            [['module_id', 'param_name'], 'string', 'max' => 100],
            [['param_value'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_id' => 'Модуль',
            'param_name' => 'Параметр',
            'param_value' => 'Значение',
            'create_time' => 'Время добавления',
            'update_time' => 'Время обновления',
            'upload_image' => 'Изображение заглушка для товара',
            'user_id' => 'Пользователь',
            'type' => 'Тип',
        ];
    }
}
