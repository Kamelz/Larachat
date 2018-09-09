# laravel messaging system


* [Installation](#installation)
* [Usage](#usage)
  * [Send message](#send-message)
  * [Mark message](#mark-message)
  * [Get user messages](#get-user-messages)

* [Unit Testing](#unit-testing)
* [TODO](#todo)


## Installation

Install the package via composer:

``` bash
composer require kamelz/larachat
```
If you are using a laravel version older than 5.5 then add the service provider in `config/app.php`.

```php
'providers' => [
    // ...
    Kamelz\Larachat\LarachatServiceProvider::class,
];
```
Publish migration files with: 

```bash
php artisan vendor:publish
```
After that run the migration command:

```bash
php artisan migrate
```

## Usage

### Send message
	
```php
You may pass a user model or the user ID in the $from and $to parameters.

$from; 		// User model or Integer
$to; 		// User model or Integer
$message; 	// String message

Message::send($from,$to,$message);

```

### Mark message

```php

$message; // Message model

$message->is_read; // 0

Message::markAsRead($message);

$message->is_read; // 1

```

You can also mark it as unread.

```php

$message; // Message model

$message->is_read; // 1

Message::markAsUnread($message);

$message->is_read; // 0

```

### Get user messages

```php

$user; // User model or Integer

Message::getUserMessages($user);

Returns an `Eloquent\Collection` of `Message` model.

```

You can get read/unread messages

```php

$user; // User model or Integer

Message::getUnreadMessages($user);
Message::getRadMessages($user);

```


## TODO

	- Blade component 
	- Send email  