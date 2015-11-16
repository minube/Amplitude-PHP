<?php

namespace Amplitude\Exceptions;

class InvalidArgumentException extends AbstractException
{
    protected $code = 501;
    protected $message = "Invalid identifier.";
}
