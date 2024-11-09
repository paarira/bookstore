<?php

namespace app\infotech\books\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $year
 * @property string $isbn
 * @property string $image_path
 * @property int $created_at
 * @property int $updated_at
 */
class Book extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%books}}';
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class
        ];
        return $behaviors;
    }

    public function rules(): array
    {
        return [
            [['title', 'year', 'isbn'], 'required'],

            ['isbn', 'unique'],

            [['title', 'description', 'image_path'], 'string'],

            ['year', 'integer']
        ];
    }

    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }
}