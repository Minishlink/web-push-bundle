# MinishlinkWebPushBundle

This bundle provides a simple integration of the [WebPush library](https://github.com/Minishlink/web-push).

## Usage
Web Push sends notifications to endpoints which server delivers web push notifications as described in
the [Web Push API specification](http://www.w3.org/TR/push-api/).

```php
<?php

$webPush = $this->container->get('web_push');
```

The bundle provides a new `web_push` service that returns an instance of `Minishlink\WebPush\WebPush`.

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
