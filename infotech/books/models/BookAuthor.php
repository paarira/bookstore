<?php

namespace app\infotech\books\models;

use app\infotech\authors\models\Author;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $book_id
 * @property int $author_id
 */
class BookAuthor extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%book_authors}}';
    }

    public function rules(): array
    {
        return [
            [['book_id', 'author_id'], 'required'],

            ['book_id', 'exist', 'targetClass' => Book::class, 'targetAttribute' => 'id'],

            ['author_id', 'exist', 'targetClass' => Author::class, 'targetAttribute' => 'id'],
        ];
    }
}