<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%redirect_counter}}`.
 */
class m260219_120354_create_redirect_counter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%redirect_counter}}', [
            'id' => $this->primaryKey(),
            'short_link_id' => $this->integer()->notNull(),
            'ip' => $this->string(15)->notNull(),
            'count_redirection' => $this->integer()->defaultValue(1)->notNull(),
        ]);

        $this->createIndex('short_link_id', '{{%redirect_counter}}', 'short_link_id');
        $this->addForeignKey('fk_shortLink_redirectCounter', '{{%redirect_counter}}', 'short_link_id', '{{%short_link}}', 'id');
        $this->createIndex('ip', '{{%redirect_counter}}', 'ip');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropforeignKey('fk_shortLink_redirectCounter', '{{%redirect_counter}}');
        $this->dropindex('short_link_id', '{{%redirect_counter}}');
        $this->dropIndex('ip', '{{%redirect_counter}}');
        $this->dropTable('{{%redirect_counter}}');
    }
}
