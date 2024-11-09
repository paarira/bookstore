<?php

namespace app\infotech\users\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const STATUS_LOCKED = 0;
    public const STATUS_ACTIVE = 10;

    public static function tableName(): string
    {
        return '{{%user}}';
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
            [['email', 'status'], 'required'],

            ['email', 'email'],

            ['email', 'unique'],

            ['status', 'in', 'range' => [self::STATUS_LOCKED, self::STATUS_ACTIVE]]
        ];
    }

    public static function findIdentity($id): ?User
    {
        return self::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?User
    {
        return self::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }


}