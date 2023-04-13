<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeProduct}}`.
 */
class m190628_143215_create_storeProduct_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product}}', [
            'id' => $this->primaryKey(),
            'producer_id' => $this->integer(),
            'type' => $this->integer(),
            'category_id' => $this->integer(),
            'sku' => $this->string(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'price' => $this->string(),
            'discount_price' => $this->string(),
            'discount' => $this->string(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'status' => $this->string(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
            'parent_id' => $this->integer(),
            'position' => $this->string(),
            'infoblock_id' => $this->integer(),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product}}');
    }
}
