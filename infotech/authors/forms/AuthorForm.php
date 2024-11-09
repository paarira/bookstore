<?php

namespace app\infotech\authors\forms;

use yii\base\Model;

class AuthorForm extends Model
{
    public $full_name;

    public function rules(): array
    {
        return [
            ['full_name', 'required'],

            ['full_name', 'string']
        ];
    }
}