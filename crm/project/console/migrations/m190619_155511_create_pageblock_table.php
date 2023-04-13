<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pageblock}}`.
 */
class m190619_155511_create_pageblock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pageblock}}', [
            'id' => $this->primaryKey(),
            'infoblock_id' => $this->integer()->notNull(),
            'staticpage_id' => $this->integer()->Null(),
            'record_id' => $this->integer()->Null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pageblock}}');
    }
}
