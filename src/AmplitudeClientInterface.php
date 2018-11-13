<?php
namespace Amplitude;

/**
 * Represents an Amplitude client.
 */
interface AmplitudeClientInterface
{
    /**
     * @param Message\Event $event
     * @return Message\Response
     */
    public function track(Message\Event $event);
}
