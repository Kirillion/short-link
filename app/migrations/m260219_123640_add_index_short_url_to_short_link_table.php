<?php

use yii\db\Migration;

class m260219_123640_add_index_short_url_to_short_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('short_link_short_url', '{{%short_link}}', 'short_url');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('short_link_short_url', '{{%short_link}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260219_123640_add_index_short_url_to_short_link_table cannot be reverted.\n";

        return false;
    }
    */
}
