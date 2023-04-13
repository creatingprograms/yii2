<?php

namespace backend\modules\catalog\models;
use backend\modules\catalog\models\StoreAttribute;

use Yii;

/**
 * This is the model class for table "storeAttributeValue".
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $number_value
 * @property string $string_value
 * @property string $text_value
 * @property int $option_value
 * @property string $create_time
 */
class StoreAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $upload_image;
	
	
    public function getStoreAttribute()
    {
        return $this->hasMany(StoreAttribute::className(), ['id' => 'attribute_id']);
    }
    
    public static function tableName()
    {
        return 'store_attribute_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'option_value'], 'integer'],
            [['text_value', 'slug'], 'string'],
            [['create_time'], 'safe'],
            [['number_value', 'string_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'number_value' => 'Цена',
            'string_value' => 'Название',
            'text_value' => 'Описание',
            'option_value' => 'Скидка',
            'create_time' => 'Create Time',
        ];
    }
}
