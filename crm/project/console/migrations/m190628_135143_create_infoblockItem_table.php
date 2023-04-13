<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%infoblockItem}}`.
 */
class m190628_135143_create_infoblockItem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%infoblock_item}}', [
            'id' => $this->primaryKey(),
            'infoblock_id' => $this->integer()->Null(),
            'title' => $this->string(),
            'anons' => $this->text(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%infoblock_item}}');
    }
}
