<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%record}}`.
 */
class m190619_154704_create_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%record}}', [
            'id' => $this->primaryKey(),
            'imageFile' => $this->text(),
            'title' => $this->string(),
            'anons' => $this->text(),
            'slug' => $this->text(),
            'imageFile' => $this->text(),
            'description' => $this->text(),
            'infoblock_id' => $this->integer()->Null(),
            'category_id' => $this->integer()->Null(),
            'link' => $this->string(),
            'text_link' => $this->text(),
            'title_file' => $this->string(),
            'allFile' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%record}}');
    }
}
