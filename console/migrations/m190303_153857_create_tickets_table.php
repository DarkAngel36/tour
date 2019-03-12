<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tickets}}`.
 */
class m190303_153857_create_tickets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tickets}}', [
            'id' => $this->primaryKey(),
            'city_from_id' => $this->integer()->notNull(),
            'city_to_id' => $this->integer()->notNull(),
            'dates' => $this->json(),
            'status' => $this->integer(1)->defaultValue(0)
        ]);

        // creates index for column `city_from_id`
        $this->createIndex(
            '{{%idx-tickets-city_from_id}}',
            '{{%tickets}}',
            'city_from_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-tickets-city_from_id}}',
            '{{%tickets}}',
            'city_from_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );

        // creates index for column `city_to_id`
        $this->createIndex(
            '{{%idx-tickets-city_to_id}}',
            '{{%tickets}}',
            'city_to_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-tickets-city_to_id}}',
            '{{%tickets}}',
            'city_to_id',
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
        $this->dropTable('{{%tickets}}');
    }
}
