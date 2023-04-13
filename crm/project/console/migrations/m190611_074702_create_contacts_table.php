<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m190611_074702_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'param_name' => $this->string(100),
            'param_value' => $this->string(500),
            'param_link' => $this->string(500),
            'param_icon' => $this->string(100),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'user_id' => $this->integer(),
            'type' => $this->integer(),
        ]);
        
        $this->insert('{{%contacts}}', [
            'param_name' => 'phone',
            'param_value' => '8(900)888-77-55',
            'param_link' => 'tel:8(900)888-77-55',
            'param_icon' => 'phone.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%contacts}}', [
            'param_name' => 'email',
            'param_value' => 'email@email.ru',
            'param_link' => 'mail:email@email.ru',
            'param_icon' => 'email.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%contacts}}', [
            'param_name' => 'socialNetwork',
            'param_value' => 'instagram',
            'param_link' => 'instagram.ru',
            'param_icon' => 'instagram.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%contacts}}', [
            'param_name' => 'socialNetworkVk',
            'param_value' => 'vk',
            'param_link' => 'vk.com',
            'param_icon' => 'vk.svg',
            'create_time' => date('Y-m-d H:i:s', time()),
            'user_id' => 1,
            'type' => 1,
        ]);
        $this->insert('{{%contacts}}', [
            'param_name' => 'socialNetworkOk',
            'param_value' => 'ok',
            'param_link' => 'ok.ru',
            'param_icon' => 'ok.svg',
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
        $this->dropTable('{{%contacts}}');
    }
}
