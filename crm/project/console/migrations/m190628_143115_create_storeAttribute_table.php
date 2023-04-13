<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeAttribute}}`.
 */
class m190628_143115_create_storeAttribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attribute}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'title' => $this->string(),
            'type' => $this->string(),
            'sort' => $this->string(),
            'slug' => $this->string(),
            'description' => $this->text(),
            'group_id' => $this->integer(),
            'param_icon' => $this->string(100),
            'imageFile' => $this->string(100),
            'price' => $this->string(),
            'discount' => $this->string(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_attribute}}');
    }
}
