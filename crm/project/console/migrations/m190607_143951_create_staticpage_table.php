<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staticpage}}`.
 */
class m190607_143951_create_staticpage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staticpage}}', [
            'id' => $this->primaryKey(),
            'title_short' => $this->string(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'description' => $this->text(),
            'imageFile' => $this->text(),
            'allFile' => $this->text(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
            'status' => $this->string(),
            'parent_id' => $this->integer(),
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
        $this->dropTable('{{%staticpage}}');
    }
}
