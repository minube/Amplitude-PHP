<?php
namespace Amplitude;

use GuzzleHttp\Client;

/**
 * Default Amplitude client implementation
 */
class AmplitudeClient implements AmplitudeClientInterface
{
    /** @var string */
    const EVENT_URI = '/httpapi';

    /** @var string */
    const IDENTIFY_URI = '/identify';

    /** @var string */
    const AMPLITUDE_BASE_URL = 'https://api.amplitude.com';

    /** @var string */
    const DEFAULT_EVENT_TYPE = 'event';

    const MAX_RETRIES = 6;
    const TIME_TO_SLEEP_PER_RETRY = 300;

    /**
     * @var string
     */
    public $apiKey = '';

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
     * @param int $retry
     * @return false | Message\Response
     */
    public function track(Message\Event $event, $retry = 0)
    {
        $request = new \GuzzleHttp\Psr7\Request('POST', self::EVENT_URI);
        $options = [
            'headers' => [
                'Accept-Encoding' => 'gzip',
            ],
            \GuzzleHttp\RequestOptions::QUERY => $this->getPostBody($event)
        ];

        try {
            return $this->getClient()->send($request, $options);
        } catch (\Exception $e) {
            if ($retry < self::MAX_RETRIES) {
                echo "Retrying {$retry} for code {$e->getCode()}\n";
                $retry++;
                sleep($retry * self::TIME_TO_SLEEP_PER_RETRY);
                return $this->track($event, $retry);
            }
        }
        return false;
    }

    /**
     * @param Message\Event $event
     * @param int $retry
     * @return false | Message\Response
     */
    public function identify(Message\Event $event, $retry = 0)
    {
        $request = new \GuzzleHttp\Psr7\Request('POST', self::IDENTIFY_URI);
        $options = [
            'headers' => [
                'Accept-Encoding' => 'gzip',
            ],
            \GuzzleHttp\RequestOptions::QUERY => $this->getPostBody($event, 'identification')
        ];

        try {
            return $this->getClient()->send($request, $options);
        } catch (\Exception $e) {
            if ($retry < self::MAX_RETRIES) {
                echo "Retrying {$retry} for code {$e->getCode()}\n";
                $retry++;
                sleep($retry * self::TIME_TO_SLEEP_PER_RETRY);
                return $this->track($event, $retry);
            }
        }
        return false;
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
    protected function getClient()
    {
        if (null === $this->client) {
            $this->client = new Client([
                'base_uri' => self::AMPLITUDE_BASE_URL,
                'timeout'  => 3.0,
                'debug' => false,
                'verify' => false,
                'decode_content' => true
            ]);
        }
        return $this->client;
    }
}
