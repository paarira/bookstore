<?php

namespace app\infotech\basis\exceptions;

use RuntimeException;
use yii\db\ActiveRecord;
use Throwable;

class ActiveRecordSaveFailedException extends RuntimeException
{
    public function __construct(ActiveRecord $model, $code = 0, Throwable $previous = null)
    {
        parent::__construct('Error while saving ' . get_class($model) . ' model', $code, $previous);
    }
}