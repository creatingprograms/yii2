<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeProductLinkType}}`.
 */
class m190628_162011_create_storeProductLinkType_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product_link_type}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(), 
            'title' => $this->string(),
        ]);
        
        $this->insert('{{%store_product_link_type}}', [
            'code' => 'similar',
            'title' => 'Похожие',
        ]);
        
        $this->insert('{{%store_product_link_type}}', [
            'code' => 'related',
            'title' => 'Сопутствующие',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product_link_type}}');
    }
}
