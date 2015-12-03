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
    protected $eventProperties = array();

    /** @var array */
    protected $userProperties = array();

    /** @var string */
    protected $appVersion;

    /** @var string */
    protected $platform;

    /** @var string */
    protected $osName;

    /** @var string */
    protected $osVersion;

    /** @var string */
    protected $deviceBrand;

    /** @var string */
    protected $deviceManufacturer;

    /** @var string */
    protected $deviceModel;

    /** @var string  */
    protected $deviceType;

    /** @var string */
    protected $carrier;

    /** @var string */
    protected $country;

    /** @var string */
    protected $region;

    /** @var string */
    protected $city;

    /** @var string */
    protected $dma;

    /** @var string */
    protected $language;

    /** @var float */
    protected $revenue;

    /** @var float */
    protected $locationLat;

    /** @var float */
    protected $locationLng;

    /** @var string */
    protected $ip;

    /** @var string */
    protected $idfa;

    /** @var string */
    protected $adid;

    /** @var integer */
    protected $sessionId;

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function set($name, $value)
    {
        if (property_exists(get_class(), $name)) {
            $this->{$name} = $value;
        }
        return $this;
    }

    /**
     * Set revenue to the main object and event properties
     * @param float $revenue
     * @return $this
     */
    public function setRevenue($revenue)
    {
        return $this->set('revenue', $revenue)
            ->addToEventProperties('revenue', $revenue);
    }

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
                'time' => $this->getTime(),
                'event_properties' => $this->getEventProperties(),
                'user_properties' => $this->getUserProperties(),
                'app_version' => $this->getAppVersion(),
                'platform' => $this->getPlatform(),
                'os_name' => $this->getOsName(),
                'os_version' => $this->getOsVersion(),
                'device_brand' => $this->getDeviceBrand(),
                'device_manufacturer' => $this->getDeviceManufacturer(),
                'device_model' => $this->getDeviceModel(),
                'device_type' => $this->getDeviceType(),
                'carrier' => $this->getCarrier(),
                'country' => $this->getCountry(),
                'region' => $this->getRegion(),
                'city' => $this->getCity(),
                'dma' => $this->getDma(),
                'language' => $this->getLanguage(),
                'revenue' => $this->getRevenue(),
                'location_lat' => $this->getLocationLat(),
                'location_lng' => $this->getLocationLng(),
                'ip' => $this->getIp(),
                'idfa' => $this->getIdfa(),
                'adid' => $this->getAdid(),
                'session_id' => $this->getSessionId(),
            )
        );
    }

    /**
     * @param sring $name
     * @param mixed $value
     * @return $this
     */
    public function addToEventProperties($name, $value)
    {
        $this->eventProperties[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function addToUserProperties($name, $value)
    {
        $this->userProperties[$name] = $value;
        return $this;
    }
}
