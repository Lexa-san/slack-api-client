# Simple PHP-client for Slack API

A simple PHP client for sending messages to [Slack](https://slack.com) through [incoming webhooks](https://api.slack.com/incoming-webhooks).

## Requirements

* PHP 5.5, 5.6, 7.0 or HHVM
* cURL extention

## Instalation

### Composer way

Add code bellow to your composer.json in project:
```json
{
    "require": {
        "Lexa-san/slack-api-client": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Lexa-san/slack-api-client"
        }
    ]
}
```

Then just run in console:
```sh
composer update --no-dev
```

## How to use

### Examle 1

```php
use Lexasan\Slack;
 
$slack = (new Slack\Client())
    ->setWebhook('https://hooks.slack.com/services/<unique_token>')
    ->from('r-t Werter')
    ->to('#my_channel')
    ->setIconEmoji(':robot_face:')
;
 
$msg = (new Slack\Message())
    ->say(sprintf('It is a test message (%s)', date('Y-m-d H:i:s')));
 
$attach = (new Slack\Attachment())
    ->setColor(Slack\Attachment::COLOR_YELLOW)
    ->addField(['title' => 'First title', 'value' => 'First value', 'short' => true])
    ->addField(['title' => 'Second title', 'value' => 'Second value', 'short' => true])
    ->addField(['title' => 'Third title', 'value' => 'Third value', 'short' => true])
    ->addField(['title' => 'Fourth title', 'value' => 'Fourth value', 'short' => true])
;
 
$slack->send(
    $msg->setAttachment($attach)
);
```

### Example 2

```php
$slack = new Client([
    'webhook' => <url>,
    'channel' => '#devs',
    'username' => 'Werter',
    'link_names' => true,
    'icon_emoji' => ':robot_face:',
]);
    
$msg = new Message([
    'channel' => '#devs',
    'username' => 'Werter',
    'text' => 'Hello world',
    'icon_emoji' => ':robot_face:',
]);

$slack->send($msg);
```
