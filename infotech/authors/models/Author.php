<?php

namespace app\infotech\authors\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $full_name
 */
class Author extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%authors}}';
    }

    public function rules(): array
    {
        return [
            ['full_name', 'required']
        ];
    }
}