<?php

use yii\db\Migration;

/**
 * Handles adding showmain to table `{{%tours}}`.
 */
class m190303_144644_add_showmain_column_to_tours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'show_main', $this->integer(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'show_main');
    }
}
