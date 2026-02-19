<?php

use yii\db\Migration;

class m260219_085846_update_short_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('short_link', 'url', $this->string(2000));
        $this->alterColumn('short_link', 'short_url', $this->string(2000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260219_085846_update_short_link_table cannot be reverted.\n";

        return false;
    }
}
