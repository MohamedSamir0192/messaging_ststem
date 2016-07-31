<?php

use yii\db\Migration;

class m160725_073206_message_recipient_table extends Migration
{
    public function up()
    {
        $this->createTable('messaging_message_recipient', [
            'id' => 'pk',
            'recipient_id' => 'INTEGER',
            'recipient_group_id' => 'INTEGER',
            'message_id' =>'INTEGER NOT NULL',
            'is_read' => 'INTEGER NOT NULL',
        ]);

        // creates index for column `recipient_id`
        $this->createIndex(
            'idx-messaging_message_recipient-recipient_id',
            'messaging_message_recipient',
            'recipient_id'
        );

        $this->addForeignKey(
            'fk-messaging_message_recipient-recipient_id',
            'messaging_message_recipient',
            'recipient_id',
            'messaging_user',
            'id',
            'CASCADE'
        );

        // creates index for column `recipient_group_id`
        $this->createIndex(
            'idx-messaging_message_recipient-recipient_group_id',
            'messaging_message_recipient',
            'recipient_group_id'
        );

        $this->addForeignKey(
            'fk-messaging_message_recipient-recipient_group_id',
            'messaging_message_recipient',
            'recipient_group_id',
            'messaging_group',
            'id',
            'CASCADE'
        );

        // creates index for column `message_id`
        $this->createIndex(
            'idx-messaging_message_recipient-message_id',
            'messaging_message_recipient',
            'message_id'
        );

        $this->addForeignKey(
            'fk-messaging_message_recipient-message_id',
            'messaging_message_recipient',
            'message_id',
            'messaging_message',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m160725_073206_message_recipient_table cannot be reverted.\n";

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
