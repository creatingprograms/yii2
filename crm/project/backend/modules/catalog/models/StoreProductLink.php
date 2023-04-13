<?php

namespace backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "store_product_link".
 *
 * @property int $id
 * @property int $product_id
 * @property int $linked_product_id
 * @property string $type
 * @property string $position
 */
class StoreProductLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'linked_product_id'], 'integer'],
            [['type', 'position'], 'string', 'max' => 255],
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
            'linked_product_id' => 'Linked Product ID',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }
}
