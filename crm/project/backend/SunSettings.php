<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sun_settings".
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
class SunSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sun_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
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
            'module_id' => 'Module ID',
            'param_name' => 'Param Name',
            'param_value' => 'Param Value',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_id' => 'User ID',
            'type' => 'Type',
        ];
    }
}
