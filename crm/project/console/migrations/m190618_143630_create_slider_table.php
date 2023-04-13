<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider}}`.
 */
class m190618_143630_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(255),
            'description' => $this->text(),
            'status' => $this->integer(),
        ]);
        $this->insert('{{%slider}}', [
            'name' => 'Слайдер на главной',
            'code' => 'index-slider',
            'description' => 'Основной слайдер сайта, расположенный сверху под шапкой сайта.',
            'status' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
