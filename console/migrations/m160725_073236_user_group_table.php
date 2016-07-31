<?php

use yii\db\Migration;

class m160725_073236_user_group_table extends Migration
{
    public function up()
    {
        $this->createTable('messaging_user_group', [
            'id' => 'pk',
            'user_id' => 'INTEGER NOT NULL',
            'group_id' => 'INTEGER NOT NULL',
            'create_date' => $this->timestamp(),
            'is_active' => 'integer DEFAULT 0'

        ]);
    

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user-group-user_id',
            'messaging_user_group',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user-group-user_id',
            'messaging_user_group',
            'user_id',
            'messaging_user',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            'idx-user-group-group_id',
            'messaging_user_group',
            'group_id'
        );

        $this->addForeignKey(
            'fk-user-group-group_id',
            'messaging_user_group',
            'group_id',
            'messaging_group',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m160725_073236_user_group_table cannot be reverted.\n";

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
