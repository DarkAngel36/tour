<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hotels_period}}`.
 */
class m190206_094843_create_hotels_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%hotels_period}}', [
            'id' => $this->primaryKey(),
            'hotel_id' => $this->integer(),
            'from' => $this->integer(10),
            'to' => $this->integer(10),
            'category' => $this->string(),
            'cost' => $this->double()->notNull(),
            'status' => $this->integer(1)->defaultValue(1)
        ]);

        // creates index for column `hotel_id`
        $this->createIndex(
            '{{%idx-hotels_period-hotel_id}}',
            '{{%hotels_period}}',
            'hotel_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-hotels_period-hotel_id}}',
            '{{%hotels_period}}',
            'hotel_id',
            '{{%hotels}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-hotels_period-hotel_id}}','{{%hotels_period}}');
        $this->dropIndex('{{%idx-hotels_period-hotel_id}}','{{%hotels_period}}');
        $this->dropTable('{{%hotels_period}}');
    }
}
