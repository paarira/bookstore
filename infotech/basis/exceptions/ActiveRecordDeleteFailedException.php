<?php

namespace app\infotech\basis\exceptions;

use RuntimeException;
use Throwable;
use yii\db\ActiveRecord;

class ActiveRecordDeleteFailedException extends RuntimeException
{
    public function __construct(ActiveRecord $model, $code = 0, Throwable $previous = null)
    {
        parent::__construct('Error while deleting ' . get_class($model) . ' model', $code, $previous);
    }
}