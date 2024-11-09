<?php

namespace app\infotech\users\exceptions;

use DomainException;
use Throwable;

class UserAlreadyExistException extends DomainException
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Пользователь уже зарегистрирован.', $code, $previous);
    }
}