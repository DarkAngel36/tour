<?php

use yii\db\Migration;

/**
 * Class m190131_144708_create_table_tour_lists
 */
class m190131_144708_create_table_tour_lists extends Migration
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

        $this->createTable('{{%tour_lists}}', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->notNull(),
            'date_from' => $this->integer()->notNull(),
            'date_to' => $this->integer()->notNull(),
            'category' => $this->integer()->notNull(),
            'cost' => $this->double()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `tours_id`
        $this->createIndex(
            '{{%idx-tour_lists-tour_id}}',
            '{{%tour_lists}}',
            'tour_id'
        );

        // add foreign key for table `{{%tours}}`
        $this->addForeignKey(
            '{{%fk-tour_lists-tour_id}}',
            '{{%tour_lists}}',
            'tour_id',
            '{{%tours}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tour_lists}}');

        echo "m190131_144708_create_table_tour_lists are reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_144708_create_table_tour_lists cannot be reverted.\n";

        return false;
    }
    */
}
