<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m241108_172536_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'description' => $this->text(),
            'year'        => $this->integer()->notNull(),
            'isbn'        => $this->string()->notNull()->unique(),
            'image_path'  => $this->string(),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
