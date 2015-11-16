<?php
namespace Amplitude;

/**
 * Default AWS client implementation
 */
class AmplitudeClient implements AmplitudeClientInterface
{

    /** @var string */
    const AMPLITUDE_URL = 'https://api.amplitude.com/httpapi';

    /**
     * @var string
     */
    protected $apiKey = '';

    /**
     * AmplitudeClient constructor.
     * @param null|string $apiKey
     */
    public function __construct($apiKey = null)
    {
        if (null !== $apiKey) {
            $this->setApiKey($apiKey);
        }
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param Message\Event $event
     * @return Message\Response
     */
    public function track(Message\Event $event)
    {

    }
}
