<?php
namespace Amplitude\Message;

/**
 * Abstract event class
 */
abstract class EventAbstract
{
    /**
     * @param string $method
     * @param mixed|null $arguments
     * @return bool
     */
    public function __call($method, $arguments = null)
    {
        if (preg_match('/(set|get)(_)?/', $method)) {
            if (substr($method, 0, 3) == "set") {
                $method = lcfirst(preg_replace('/set(_)?/', '', $method));
                if (property_exists($this, $method)) {
                    $this->{$method} = array_pop($arguments);
                    return $this;
                } else {
                    return $this;
                }
                return $this;
            } elseif (substr($method, 0, 3) == "get") {
                $method = lcfirst(preg_replace('/get(_)?/', '', $method));
                if (property_exists($this, $method)) {
                    return $this->{$method};
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            die("method $method does not exist\n");
        }
    }
}
