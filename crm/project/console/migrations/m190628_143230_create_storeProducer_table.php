<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeProducer}}`.
 */
class m190628_143230_create_storeProducer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_producer}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'anons' => $this->string(),
            'slug' => $this->string(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'status' => $this->string(),
            'sort' => $this->string(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_producer}}');
    }
}
