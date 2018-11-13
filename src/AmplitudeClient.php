<?php
namespace Amplitude;

use GuzzleHttp\Client;

/**
 * Default Amplitude client implementation
 */
class AmplitudeClient implements AmplitudeClientInterface
{
    /** @var string */
    const AMPLITUDE_EVENT_URL = 'https://api.amplitude.com/httpapi';

    /** @var string */
    const AMPLITUDE_IDENTIFY_URL = 'https://api.amplitude.com/identify';

    const DEFAULT_EVENT_TYPE = 'event';

    /**
     * @var string
     */
    protected $apiKey = '';

    /**
     * @var Client|null
     */
    protected $client = null;

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
        $request = $this->getClient(self::AMPLITUDE_EVENT_URL)->post(
            null, null, $this->getPostBody($event)
        );
        return $request->send();
    }

    /**
     * @param Message\Event $event
     * @return Message\Response
     */
    public function identify(Message\Event $event)
    {
        $request = $this->getClient(self::AMPLITUDE_IDENTIFY_URL)->post(
            null, null, $this->getPostBody($event, 'identification')
        );
        return $request->send();
    }

    /**
     * Get post body
     * @param Message\Event $event
     * @param string $type
     * @return array
     */
    protected function getPostBody(Message\Event $event, $type = self::DEFAULT_EVENT_TYPE)
    {
        return array(
            'api_key' => $this->apiKey,
            $type => $event->format(),
        );
    }

    /**
     * Get client
     * @return Client
     */
    protected function getClient($url)
    {
        if (null === $this->client) {
            $this->client = new Client($url);
        }
        return $this->client;
    }
}
