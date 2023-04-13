<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m190613_114453_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(255),
            'description' => $this->text(),
            'status' => $this->integer(),
        ]);
        $this->insert('{{%menu}}', [
            'name' => 'Верхнее меню',
            'code' => 'top-menu',
            'description' => 'Основное меню сайта, расположенное сверху в шапке сайта.',
            'status' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}
