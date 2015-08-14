<?php
/**
 * sources.
 * Date: 14/08/15
 */

require('_autoload.php');
require('_parameters.php');

use Mailxpert\Mailxpert;

session_start();

$mailxpert = new Mailxpert([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'api_base_url' => 'http://api.mailxpert.dev/app_dev.php',
    'oauth_base_url' => 'http://app.mailxpert.dev/app_dev.php'
]);

if (isset($_SESSION['access_token'])) {
    $mailxpert->setAccessToken($_SESSION['access_token']);

    $response = $mailxpert->sendRequest('GET', 'contact_lists');

    var_dump($response->getBody());
} else {
    if (isset($_REQUEST['code'])) {
        $accessToken = $mailxpert->getLoginHelper()->getAccessToken($redirectUrl);

        $_SESSION['access_token'] = $accessToken;

        echo "<p>You are now connected</p><a href=\"oauth.php\">Refresh</a>";
    } else {
        echo sprintf('<a href="%s">Login with mailXpert</a>', $mailxpert->getLoginHelper()->getLoginUrl($redirectUrl));
    }
}