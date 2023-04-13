<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeCategory}}`.
 */
class m190628_143159_create_storeCategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title' => $this->string(), 
            'slug' => $this->string(),
            'imageFile' => $this->text(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'meta_title' => $this->text(),
            'meta_description' => $this->text(),
            'meta_keywords' => $this->text(),
            'status' => $this->string(),
            'sort' => $this->string(),
            'type' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_category}}');
    }
}
