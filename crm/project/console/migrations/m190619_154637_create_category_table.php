<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190619_154637_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'imageFile' => $this->text(),
            'title' => $this->string(),
            'description' => $this->text(),
            'parent_id' => $this->integer(),
            'slug' => $this->string(),
            'type' => $this->string(),
        ]);
        $this->insert('{{%category}}', [
            'title' => 'Главная',
            'slug' => 'glavnaya',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
