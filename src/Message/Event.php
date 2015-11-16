<?php
namespace Amplitude\Message;

/**
 * Event to be tracked by Amplitude
 */
class Event
{
    /** @var int */
    protected $userId;

    /** @var int */
    protected $deviceId;

    /** @var string */
    protected $eventType;

    /** @var long */
    protected $time;

    /** @var array */
    protected $eventProperties;

    /** @var array */
    protected $userProperties;

    /** @var string */
    protected $appVersion;
}
