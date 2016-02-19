<?php
/**
 * Example of OAuth manipulation.
 *
 * Change your own settings in common/_parameters.php
 */

require_once('common/bootstrap.php');

use Mailxpert\Mailxpert;

$mailxpert = new Mailxpert([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'api_base_url' => 'http://api.mailxpert.dev/app_dev.php',
    'oauth_base_url' => 'http://app.mailxpert.dev/app_dev.php'
]);


session_start();

if (isset($_SESSION['access_token'])) {
    $mailxpert->setAccessToken($_SESSION['access_token']);
}

$page = isset($_GET['p'])?$_GET['p']:'';

switch ($page) {
    case 'cp-customers':
        require('cp-customers.php');
        break;
    case 'contactlists':
        require('contactlists.php');
        break;
    case 'refresh_token':
        require('refreshtoken.php');
        break;
    default:
        if (isset($_SESSION['access_token'])) {
            require('menu.php');
        } else {
            require('login.php');
        }
        break;
}
