<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storeSettings}}`.
 */
class m190628_162055_create_storeSettings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_settings}}', [
            'id' => $this->primaryKey(),
            'module_id' => $this->string(100), 
            'param_name' => $this->string(100),
            'param_value' => $this->string(500),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'user_id' => $this->integer(),
            'type' => $this->integer(),
        ]);
        
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'renderIndex',
            'param_value' => '1',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'currency',
            'param_value' => 'RUB',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'productCount',
            'param_value' => '10',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'productSort',
            'param_value' => 'create_time',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'routeSort',
            'param_value' => '1',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'storeTitle',
            'param_value' => 'Солнечный стиль вашего магазина на yii2!',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'storeDescription',
            'param_value' => 'Солнечный стиль вашего сайта на yii2!',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'siteKeyWords',
            'param_value' => 'магазин, yii2',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%store_settings}}', [
            'module_id' => 'sun',
            'param_name' => 'defaultImage',
            'param_value' => 'no_image.svg',
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
        $this->dropTable('{{%store_settings}}');
    }
}
