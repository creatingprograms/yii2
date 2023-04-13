<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m190607_093453_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'module_id' => $this->string(100), 
            'param_name' => $this->string(100),
            'param_value' => $this->string(500),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'user_id' => $this->integer(),
            'type' => $this->integer(),
        ]);
        
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'logo',
            'param_value' => 'logo.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'siteName',
            'param_value' => 'Sun!',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'siteDescription',
            'param_value' => 'Солнечный стиль вашего сайта на yii2!',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'siteKeyWords',
            'param_value' => 'сайт, yii2',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'email',
            'param_value' => '',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'defaultLanguage',
            'param_value' => 'ru',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'availableLanguages',
            'param_value' => 'ru,en',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'allowedExtensions',
            'param_value' => 'jpg,png,svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'defaultImage',
            'param_value' => 'no_image.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'indexation',
            'param_value' => 1,
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%settings}}', [
            'module_id' => 'sun',
            'param_name' => 'typeSite',
            'param_value' => 1,
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
