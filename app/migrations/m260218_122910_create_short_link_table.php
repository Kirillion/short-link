<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%short_link}}`.
 */
class m260218_122910_create_short_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%short_link}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'short_url' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%short_link}}');
    }
}
