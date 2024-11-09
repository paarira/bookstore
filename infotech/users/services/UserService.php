<?php

namespace app\infotech\users\services;

use app\infotech\users\forms\LoginForm;
use app\infotech\users\forms\UserCreateForm;
use app\infotech\users\models\User;
use app\infotech\users\repositories\UserRepository;
use app\infotech\users\exceptions\UserAlreadyExistException;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserCreateForm $form): User
    {
        if ($this->userRepository->existByEmail($form->email)) {
            throw new UserAlreadyExistException();
        }

        $user = new User([
            'email'         => $form->email,
            'password_hash' => \Yii::$app->security->generatePasswordHash($form->password),
            'status'        => User::STATUS_ACTIVE,
            'auth_key'      => \Yii::$app->security->generateRandomString()
        ]);
        $this->userRepository->save($user);

        return $user;
    }
}