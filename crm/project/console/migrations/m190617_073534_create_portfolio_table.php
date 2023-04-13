<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio}}`.
 */
class m190617_073534_create_portfolio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'description' => $this->text(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'status' => $this->string(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
            'create_time' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%portfolio}}');
    }
}
