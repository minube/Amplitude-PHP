Amplitude PHP
=============

How to use it
-------------

```php
$apiKey = 123456;
$amplitudeClient = new \Amplitude\AmplitudeClient($apiKey);

$amplitudeEvent = new \Amplitude\AmplitudeEvent();

// For user properties
$amplitudeEvent->set('city_id', 123)
    ->set('country_id', 34);
    
// For event properties
$amplitudeEvent->addToEventProperties('revenue', 12.34);

$response = $amplitudeClient->track($amplitudeEvent);
```
