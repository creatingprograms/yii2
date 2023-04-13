<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%constructform}}`.
 */
class m190828_131728_create_constructform_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%constructform}}', [
            'id' => $this->primaryKey(),
            'nabor1' => $this->text(),
            'nabor2' => $this->text(),
            'nabor3' => $this->text(),
            'nabor4' => $this->text(),
            'nabor5' => $this->text(),
            'nabor6' => $this->text(),
            'nabor7' => $this->text(),
            'nabor8' => $this->text(),
            'nabor9' => $this->text(),
            'nabor10' => $this->text(),
            'nabor11' => $this->text(),
            'imageFile' => $this->text(),
            'created_at' => $this->dateTime(),
            'type' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%constructform}}');
    }
}
