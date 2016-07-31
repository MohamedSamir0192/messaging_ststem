<?php

use yii\db\Migration;

class m160725_073124_user_table extends Migration
{

    public function up()
    {
        $this->createTable('messaging_user', [
            'id' => 'pk',
            'first_name' => 'varchar(150) NOT NULL',
            'last_name' => 'varchar(150) NOT NULL',
            'create_date' => $this->timestamp(),
            'is_active' => 'integer DEFAULT 0'

        ]);
    }

    public function down()
    {
        echo "m160725_073124_user_table cannot be reverted.\n";

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
