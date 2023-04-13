<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%infoblock}}`.
 */
class m190619_155531_create_infoblock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%infoblock}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'anons' => $this->text(),
            'slug' => $this->string(),
            'link' => $this->string(),
            'text_link' => $this->string(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'type' => $this->string(),
            'indexok' => $this->string(),
            'description' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%infoblock}}');
    }
}
