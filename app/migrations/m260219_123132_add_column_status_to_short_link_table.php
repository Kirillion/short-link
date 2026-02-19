<?php

use yii\db\Migration;

class m260219_123132_add_column_status_to_short_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('short_link', 'status', $this->integer()->defaultValue(1));
        $this->createIndex('short_link_status', 'short_link', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('short_link_status', 'short_link');
        $this->dropColumn('short_link', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260219_123132_add_column_status_to_short_link_table cannot be reverted.\n";

        return false;
    }
    */
}
