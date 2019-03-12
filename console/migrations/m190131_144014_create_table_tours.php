<?php

use yii\db\Migration;

/**
 * Class m190131_144014_create_table_tours
 */
class m190131_144014_create_table_tours extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'info' => $this->text(),
            'city_id' => $this->integer()->notNull(),
            'options' => $this->text(),
            'programm' => $this->text(),
            'img' => $this->string(),
            'img_list' => $this->json(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tours}}');

        echo "m190131_144014_create_table_tours are reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_144014_create_table_tours cannot be reverted.\n";

        return false;
    }
    */
}
