<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%constructor}}`.
 */
class m190802_121301_create_constructor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%constructor}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'iconFile' => $this->text(),
            'imageFile' => $this->text(),
            'price' => $this->text(),
            'parent_id' => $this->integer(),
            'color' => $this->text(),
            'logo' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%constructor}}');
    }
}
