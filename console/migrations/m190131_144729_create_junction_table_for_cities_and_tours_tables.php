<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cities_tours}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cities}}`
 * - `{{%tours}}`
 */
class m190131_144729_create_junction_table_for_cities_and_tours_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities_tours}}', [
            'cities_id' => $this->integer(),
            'tours_id' => $this->integer(),
            'PRIMARY KEY(cities_id, tours_id)',
        ]);

        // creates index for column `cities_id`
        $this->createIndex(
            '{{%idx-cities_tours-cities_id}}',
            '{{%cities_tours}}',
            'cities_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-cities_tours-cities_id}}',
            '{{%cities_tours}}',
            'cities_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tours_id`
        $this->createIndex(
            '{{%idx-cities_tours-tours_id}}',
            '{{%cities_tours}}',
            'tours_id'
        );

        // add foreign key for table `{{%tours}}`
        $this->addForeignKey(
            '{{%fk-cities_tours-tours_id}}',
            '{{%cities_tours}}',
            'tours_id',
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
        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-cities_tours-cities_id}}',
            '{{%cities_tours}}'
        );

        // drops index for column `cities_id`
        $this->dropIndex(
            '{{%idx-cities_tours-cities_id}}',
            '{{%cities_tours}}'
        );

        // drops foreign key for table `{{%tours}}`
        $this->dropForeignKey(
            '{{%fk-cities_tours-tours_id}}',
            '{{%cities_tours}}'
        );

        // drops index for column `tours_id`
        $this->dropIndex(
            '{{%idx-cities_tours-tours_id}}',
            '{{%cities_tours}}'
        );

        $this->dropTable('{{%cities_tours}}');
    }
}
