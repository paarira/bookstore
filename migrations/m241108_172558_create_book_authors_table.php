<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_authors}}`.
 */
class m241108_172558_create_book_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_authors}}', [
            'id'        => $this->primaryKey(),
            'book_id'   => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-book_authors-book_id', '{{%book_authors}}', 'book_id');
        $this->createIndex('idx-book_authors-author_id', '{{%book_authors}}', 'author_id');

        $this->addForeignKey(
            'fk-book_authors-book',
            '{{%book_authors}}',
            'book_id',
            '{{%books}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-book_authors-author',
            '{{%book_authors}}',
            'author_id',
            '{{%authors}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-book_authors-book', '{{%book_authors}}');
        $this->dropForeignKey('fk-book_authors-author', '{{%book_authors}}');
        $this->dropIndex('idx-book_authors-book_id', '{{%book_authors}}');
        $this->dropIndex('idx-book_authors-author_id', '{{%book_authors}}');

        $this->dropTable('{{%book_authors}}');
    }
}
