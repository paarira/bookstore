<?php

namespace app\infotech\users\forms;

use app\infotech\users\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required']
        ];
    }
    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'Пользователь с таким логином не найден.');
            return false;
        }

        if (!\Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            $this->addError('password', 'Неверный пароль.');
            return false;
        }
        return \Yii::$app->user->login($user, 0);
    }
}