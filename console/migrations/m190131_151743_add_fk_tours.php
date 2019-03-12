<?php

use yii\db\Migration;

/**
 * Class m190131_151743_add_fk_tours
 */
class m190131_151743_add_fk_tours extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column `cities_id`
        $this->createIndex(
            '{{%idx-tours-city_id}}',
            '{{%tours}}',
            'city_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-tours-city_id}}',
            '{{%tours}}',
            'city_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-tours-city_id}}',
            '{{%tours}}'
        );

        // drops index for column `cities_id`
        $this->dropIndex(
            '{{%idx-tours-city_id}}',
            '{{%tours}}'
        );
        echo "m190131_151743_add_fk_tours are reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_151743_add_fk_tours cannot be reverted.\n";

        return false;
    }
    */
}
