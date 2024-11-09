<?php

namespace app\infotech\books\forms;

use yii\base\Model;

class BookEditForm extends Model
{
    public $title;
    public $description;
    public $year;
    public $isbn;
    public $image;
    public $image_old;
    public $authors = [];

    public function rules(): array
    {
        return [
            [['title', 'year', 'isbn'], 'required'],

            [['title', 'year', 'isbn', 'description', 'image_old'], 'string'],

            ['image', 'file', 'maxFiles' => 1, 'skipOnError' => true],

            ['authors', 'each', 'rule' => ['integer']]
        ];
    }
}