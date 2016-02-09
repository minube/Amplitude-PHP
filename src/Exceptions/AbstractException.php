<?php

namespace Amplitude\Exceptions;

abstract class AbstractException extends \Exception
{
    /** @var int */
    protected $code = 500;

    /** @var string */
    protected $message = 'Amplitude Error';
}
