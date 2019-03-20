<?php

use yii\db\Migration;

/**
 * Class m190319_232704_add_field_to_tours_table
 */
class m190319_232704_add_field_to_tours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'short_description', $this->text());
        $this->addColumn('{{%tours}}', 'cost', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'short_description');
        $this->dropColumn('{{%tours}}', 'cost');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190319_232704_add_field_to_tours_table cannot be reverted.\n";

        return false;
    }
    */
}
