<?php

use yii\db\Migration;

class m160725_073140_message_table extends Migration
{
    public function up()
    {
        $this->createTable('messaging_message', [
            'id' => 'pk',
            'subject' => 'varchar(100) NOT NULL',
            'creator_id' => 'INTEGER NOT NULL',
            'message_body' =>'TEXT NOT NULL',
            'create_date' => $this->timestamp(),
            'parent_message_id' => 'INTEGER',
            'expiry_date' => $this->timestamp(),
        ]);
    
        // creates index for column `creator_id`
        $this->createIndex(
            'idx-message-creator_id',
            'messaging_message',
            'creator_id'
        );

        $this->addForeignKey(
            'fk-message-creator_id',
            'messaging_message',
            'creator_id',
            'messaging_user',
            'id',
            'CASCADE'
        );

        // creates index for column `parent_message_id`
        $this->createIndex(
            'idx-message-parent_message_id',
            'messaging_message',
            'parent_message_id'
        );

        $this->addForeignKey(
            'fk-message-parent_message_id',
            'messaging_message',
            'parent_message_id',
            'messaging_message',
            'parent_message_id',
            'CASCADE'
        );

    }

    public function down()
    {
        echo "m160725_073140_message_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
