<?php

namespace backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\modules\catalog\models\StoreAttributeValue;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "store_attribute_group".
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property int $product_id
 * @property string $imageFile
 */
class StoreAttributeGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $upload_image;
    
    public function getStoreAttribute()
    {
        return $this->hasMany(StoreAttribute::className(), ['group_id' => 'id']);
    }
    
    public static function tableName()
    {
        return 'store_attribute_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position'], 'integer'],
            [['imageFile'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'position' => 'Позиция',
            'imageFile' => 'Изображение',
        ];
    }
    
    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'imageFile')){
            $dir = Yii::getAlias('@images').'/images/';
            if(file_exists($dir.$this->imageFile)){
                unlink($dir.$this->imageFile);
            }
            $this->imageFile = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' .$file->extension;
            $file->saveAs($dir.$this->imageFile);
            //die($dir.$this->imageFile);
            
            $time = new DateTime('now', new DateTimeZone('UTC'));
            $this->created_at = $time->format('Y-m-d H:m:s');
        }
        return true;
    }
}
