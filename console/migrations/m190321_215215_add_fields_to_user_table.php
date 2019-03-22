<?php

use yii\db\Migration;

/**
 * Class m190321_215215_add_fields_to_user_table
 */
class m190321_215215_add_fields_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string());
        $this->addColumn('{{%user}}', 'last_name', $this->string());
        $this->addColumn('{{%user}}', 'middle_name', $this->string());
        $this->addColumn('{{%user}}', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'middel_name');
        $this->dropColumn('{{%user}}', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190321_215215_add_fields_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
