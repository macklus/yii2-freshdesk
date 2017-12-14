Yii2 Freshdesk extension
========================
Simple Yii2 module to extend Freshdesk API

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist macklus/yii2-freshdesk "*"
```

or add

```
"macklus/yii2-freshdesk": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply declare a component in your config file:

```php
'freshdesk' => [
    'class' => 'macklus\freshdesk\Freshdesk',
    'api_key' => 'ThisIsAFakeApiKey',
    'domain' => 'macklus',
],
```

After that, you can call Freshdesk API by using:

```
$response = Yii::$app->freshdesk->tickets->create([
    'name' => 'Customer name',
    'email' => 'Customer Email',
    'cc_emails' => ['Customer Email'],
    'subject' => "Your ticket",
    'description' => 'The content of ticket',
    'status' => 2,
    'priority' => 1,
]);
```