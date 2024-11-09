<?php

namespace app\infotech\users\repositories;

use app\infotech\basis\BaseRepository;
use app\infotech\basis\exceptions\ActiveRecordNotFoundException;
use app\infotech\users\models\User;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function existByEmail(string $email): bool
    {
        return User::find()->where(['=', 'email', mb_strtolower($email)])->exists();
    }

    public function getByEmail(string $email): User
    {
        $model = User::findOne(['email' => $email]);
        if ($model) {
            return $model;
        }
        throw new ActiveRecordNotFoundException(User::class);
    }
}