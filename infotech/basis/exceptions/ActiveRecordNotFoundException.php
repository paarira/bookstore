<?php

namespace app\infotech\basis\exceptions;

use RuntimeException;
use Throwable;

class ActiveRecordNotFoundException extends RuntimeException
{
    public function __construct(string $class, $code = 0, Throwable $previous = null)
    {
        parent::__construct('Active record model of ' . $class . ' not found', $code, $previous);
    }
}