<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeAttributeGroup}}`.
 */
class m190628_143139_create_storeAttributeGroup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attribute_group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'position' => $this->integer(),
            'product_id' => $this->integer(),
            'imageFile' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_attribute_group}}');
    }
}
