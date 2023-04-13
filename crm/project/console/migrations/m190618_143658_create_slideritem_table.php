<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slideritem}}`.
 */
class m190618_143658_create_slideritem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slideritem}}', [
            'id' => $this->primaryKey(),
            'slider_id' => $this->integer(),
            'producer_id' => $this->integer(),
            'title' => $this->string(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'description' => $this->text(),
            'href' => $this->string(),
            'sort' => $this->text(),
            'status' => $this->text(),
            'background' => $this->string(),
            
        ]);
        $this->insert('{{%slideritem}}', [
            'slider_id' => 1,
            'title' => 'Главный слайд',
            'imageFile' => 'no_image.svg',
            'description' => 'Описание главного слайда на домашней странице',
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
        $this->dropTable('{{%slideritem}}');
    }
}
