<?php

namespace app\infotech\authors\forms;

use yii\base\Model;

class GenerateReportForm extends Model
{
    public $year;

    public function rules(): array
    {
        return [
            ['year', 'required'],

            ['year', 'integer'],
        ];
    }
}