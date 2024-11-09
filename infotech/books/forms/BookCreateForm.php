<?php

namespace app\infotech\books\forms;

use yii\base\Model;

class BookCreateForm extends Model
{
    public $title;
    public $description;
    public $year;
    public $isbn;
    public $image;
    public $authors = [];

    public function rules(): array
    {
        return [
            [['title', 'year', 'isbn'], 'required'],

            [['title', 'isbn', 'description'], 'string'],

            ['year', 'integer'],

            ['image', 'file', 'maxFiles' => 1]
        ];
    }
}