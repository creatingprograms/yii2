<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeProducerItem}}`.
 */
class m190628_164512_create_storeProducerItem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_producer_item}}', [
            'id' => $this->primaryKey(),
            'producer_id' => $this->integer(),
            'title' => $this->string(),
            'anons' => $this->string(),
            'slug' => $this->string(),
            'imageFile' => $this->text(),
            'description' => $this->text(),
            'type' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_producer_item}}');
    }
}
