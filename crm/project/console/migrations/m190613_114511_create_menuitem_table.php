<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menuitem}}`.
 */
class m190613_114511_create_menuitem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menuitem}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'menu_id' => $this->integer(),
            'title' => $this->string(),
            'imageFile' => $this->text(),
            'href' => $this->string(),
            'sort' => $this->text(),
            'status' => $this->text(),
            
        ]);
        $this->insert('{{%menuitem}}', [
            'menu_id' => 1,
            'title' => 'Главная',
            'href' => '/',
            'sort' => 1,
            'status' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menuitem}}');
    }
}
