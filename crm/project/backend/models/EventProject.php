<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_project".
 *
 * @property int $id
 * @property int $project_id
 * @property int $event_id
 * @property string $create_time
 */
class EventProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'event_id'], 'integer'],
            [['create_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'event_id' => 'Event ID',
            'create_time' => 'Create Time',
        ];
    }
}
