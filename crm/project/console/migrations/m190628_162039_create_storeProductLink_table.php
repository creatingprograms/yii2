<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeProductLink}}`.
 */
class m190628_162039_create_storeProductLink_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_link}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'linked_product_id' => $this->integer(),
            'type' => $this->string(),
            'position' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product_link}}');
    }
}
