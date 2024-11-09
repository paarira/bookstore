<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m241108_175107_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriptions}}', [
            'id'         => $this->primaryKey(),
            'book_id'    => $this->integer()->notNull(),
            'phone'      => $this->string()->notNull(),
            'status'     => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-subscriptions-book_id', '{{%subscriptions}}', 'book_id');
        $this->addForeignKey(
            'fk-subscriptions-book',
            '{{%subscriptions}}',
            'book_id',
            '{{%books}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-subscriptions-book', '{{%subscriptions}}');
        $this->dropIndex('idx-subscriptions-book_id', '{{%subscriptions}}');

        $this->dropTable('{{%subscriptions}}');
    }
}
