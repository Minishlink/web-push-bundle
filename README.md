# MinishlinkWebPushBundle
This bundle provides a simple integration of the [WebPush library](https://github.com/Minishlink/web-push).

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0c2947f7-f173-4d00-b0bb-da26613d52a2/mini.png)](https://insight.sensiolabs.com/projects/0c2947f7-f173-4d00-b0bb-da26613d52a2)

## Usage
Web Push sends notifications to endpoints which server delivers web push notifications as described in
the [Web Push API specification](http://www.w3.org/TR/push-api/).

```php
<?php
/** @var \Minishlink\WebPush\WebPush */
$webPush = $this->container->get('minishlink_web_push');
```

The bundle provides a new `minishlink_web_push` service that returns an instance of `Minishlink\WebPush\WebPush`.

For more info on what you can do with `$webPush`, check [Minishlink/web-push](https://github.com/Minishlink/web-push).

## Installation

1. `composer require minishlink/web-push-bundle`
2. Enable the bundle in your `app/AppKernel.php`.

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Minishlink\Bundle\WebPushBundle\MinishlinkWebPushBundle(),
        // ...
    );
}
```

## Configuration
Here is the default configuration, you may change it in your `app/config/config.yml`.

```yml
minishlink_web_push:
  VAPID:
    subject: https://yoursite.com # can be an URL or a mailto:
    publicKey: ~88 chars          # uncompressed public key P-256 encoded in Base64-URL
    privateKey: ~44 chars         # the secret multiplier of the private key encoded in Base64-URL
    pemFile: path/to/pem          # if you have a PEM file and can link to it on your filesystem
    pem: pemFileContent           # if you have a PEM file and want to hardcode its content
  ttl: 2419200                    # Time to Live of notifications in seconds
  urgency: ~                      # can be very-low / low / normal / high
  topic: ~                        # default identifier for your notifications
  timeout: 30                     # Timeout of each request in seconds
  automatic_padding: true         # pad messages automatically for better security (against more bandwith usage)
```
