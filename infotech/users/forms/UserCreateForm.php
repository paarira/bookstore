<?php

namespace app\infotech\users\forms;

use yii\base\Model;

class UserCreateForm extends Model
{
    public $email;
    public $password;
    public $password_repaet;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],

            ['email', 'email'],

            ['password', 'compare', 'compareAttribute' => 'password_repeat']
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email'           => 'Email',
            'password'        => 'Пароль',
            'password_repeat' => 'Повторите пароль'
        ];
    }
}