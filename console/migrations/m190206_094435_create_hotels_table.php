<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hotels}}`.
 */
class m190206_094435_create_hotels_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%hotels}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'img' => $this->string(),
            'img_list' => $this->json(),
            'status' => $this->integer()->defaultValue(1)
        ]);

        // creates index for column `citн_id`
        $this->createIndex(
            '{{%idx-hotels-city_id}}',
            '{{%hotels}}',
            'city_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-hotels-city_id}}',
            '{{%hotels}}',
            'city_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%hotels}}');
    }
}
