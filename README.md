Please see [this repo](https://github.com/laravel-notification-channels/channels) for instructions on how to submit a channel proposal.

# A Boilerplate repo for contributions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/touch-sms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/touch-sms)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/touch-sms/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/touch-sms)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/touch-sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/touch-sms)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/touch-sms/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/touch-sms/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/touch-sms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/touch-sms)

📲  TouchSMS Notifications Channel for Laravel

## Contents

- [Installation](#installation)
	- [Setting up the TouchSms service](#setting-up-the-TouchSms-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

```bash
composer require laravel-notification-channels/touch-sms
```

Add the configuration to your `services.php` config file:

```php
'touchsms' => [
    'token_id' => env('TOUCHSMS_TOKEN_ID'),
    'access_token' => env('TOUCHSMS_ACCESS_TOKEN'),
    'default_sender' => env('TOUCHSMS_DEFAULT_SENDER', null),
]
```

### Setting up the TouchSms service

You'll need a TouchSMS account. Head over to their [website](https://www.touchsms.com.au/) and create or login to your account.

Head to `Settings` and then `API keys` in the sidebar to generate a set of API keys.

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use \NotificationChannels\TouchSms\TouchSmsMessage;
use \NotificationChannels\TouchSms\TouchSmsChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [TouchSmsChannel::class];
    }

    public function toSmsbroadcast($notifiable)
    {
        return (new TouchSmsMessage)
            ->content("Task #{$notifiable->id} is complete!");
    }
}
```

In your notifiable model, make sure to include a `routeNotificationForTouchsms()` method, which returns an australian or new zeland phone number in the international format.

```php
public function routeNotificationForTouchsms()
{
    return $this->phone; // 6142345678
}
```

### Available methods

`sender()`: Sets the sender's name or phone number.

`content()`: Set a content of the notification message.

`reference()`: Set the SMS reference code (included with replies/delivery receipt callbacks)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email support@touchsms.com.au instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [TouchSms](https://github.com/touchsms)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
