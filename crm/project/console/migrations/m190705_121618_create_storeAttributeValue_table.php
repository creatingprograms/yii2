<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeAttributeValue}}`.
 */
class m190705_121618_create_storeAttributeValue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_attribute_value}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'number_value' => $this->string(),
            'string_value' => $this->string(),
            'text_value' => $this->text(),
            'option_value' => $this->integer(),
            'create_time' => $this->dateTime(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_attribute_value}}');
    }
}
