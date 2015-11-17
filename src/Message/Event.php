<?php
namespace Amplitude\Message;

/**
 * Event to be tracked by Amplitude
 */
class Event extends EventAbstract
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

    /**
     * Format entity
     * @return string
     */
    public function format()
    {
        return json_encode(
            array(
                'user_id' => $this->getUserId(),
                'device_id' => $this->getDeviceId(),
                'event_type' => $this->getEventType(),
                'event_properties' => $this->getEventProperties(),
                'user_properties' => $this->getUserProperties(),
                'time' => $this->getTime(),
                'app_version' => $this->getAppVersion(),
            )
        );
    }
}
