<?php

use yii\db\Migration;

class m160725_073226_group_table extends Migration
{
    public function up()
    {
        $this->createTable('messaging_group', [
            'id' => 'pk',
            'name' => 'varchar(150) NOT NULL',
            'create_date' => $this->timestamp(),
            'is_active' => 'integer DEFAULT 0'

        ]);
    }

    public function down()
    {
        echo "m160725_073226_group_table cannot be reverted.\n";

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
