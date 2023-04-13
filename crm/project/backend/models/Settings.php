<?php

namespace backend\models;

use Yii;
use DateTime;
use DateTimeZone;


/**
 * This is the model class for table "settings".
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
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload_image;
    public $upload_image1;
    
    
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['upload_image'], 'file', 'extensions' => 'svg, png, jpg', 'skipOnEmpty' => true],
            [['upload_image1'], 'file', 'extensions' => 'xlsx, xls, docx, doc', 'skipOnEmpty' => true],
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
            'upload_image' => 'Логотип',
            'upload_image1' => 'Прайс лист',
            'param_name' => 'Название параметра',
            'siteDescription' => 'Название параметра',
            'param_value' => 'Значение',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_id' => 'User ID',
            'type' => 'Type',
        ];
    }
}
