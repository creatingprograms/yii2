<?php

namespace backend\modules\forum\models;

use Yii;

/**
 * This is the model class for table "pageblock".
 *
 * @property int $id
 * @property int $infoblock_id
 * @property int $staticpage_id
 */
class Pageblock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pageblock';
    }

    /**
     * {@inheritdoc}
     */
    
    public function getStaticpage()
    {
        return $this->hasOne(Staticpage::className(), ['id' => 'staticpage_id']);
    }
    
    public function getRecord()
    {
        return $this->hasOne(Record::className(), ['id' => 'record_id']);
    }
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoblock()
    {
        return $this->hasOne(Infoblock::className(), ['id' => 'infoblock_id']);
    }
    
    
    public function rules()
    {
        return [
            [['infoblock_id'], 'required'],
            [['infoblock_id', 'staticpage_id', 'record_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'infoblock_id' => 'Инфоблок',
            'staticpage_id' => 'Статическая страница',
            'record_id' => 'Запись',
        ];
    }
    
    
}
