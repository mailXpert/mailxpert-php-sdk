# mailXpert PHP SDK for API V2.0

This library allows you to easily manipulate the mailXpert API V2.0.

NOTE: This library is still considered as in alpha release. Although it is meant to be light and there is no plan for big changes in it, be careful if planned to use in production environment.

## Installation

Install this package with composer:

```
composer require mailxpert/php-sdk
```

## Usage

You can check the ```examples/``` folders.

### Initialisation

The basic usage is the following:

```
$mailxpert = new Mailxpert([
    'app_id' => $appId,
    'app_secret' => $appSecret 
]);
```

### Show the "Login with mailXpert" button

```
<a href="<?php echo $mailxpert->getLoginHelper()->getLoginUrl($redirectUrl); ?>">Login with mailXpert</a>
```

### Retrieve the access token from the code

```
if (isset($_REQUEST['code'])) {
    $accessToken = $mailxpert->getLoginHelper()->getAccessToken($redirectUrl);
}
```

### Do a query with the access token

```
$data = json_deconde($mailxpert->sendRequest('GET','/contact_lists',[], $accessToken), true);
$contactLists = $data['data'];
```

Note: You can also set the access token for all your requests:

```
$mailxpert->setAccessToken($access_token);
```

and then you can do any call like this:

```
$mailxpert->sendRequest('GET','/contact_lists');
```

## Support

Made by ARTACK WebLab GmbH. Feel free to contribute or submit issues.


*** Inspired from Facebook PHP SDK 4.0 [https://github.com/facebook/facebook-php-sdk-v4](https://github.com/facebook/facebook-php-sdk-v4) ***
