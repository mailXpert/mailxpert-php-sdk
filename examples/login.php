<?php

if (isset($_REQUEST['code'])) {
    $accessToken = $mailxpert->getLoginHelper()->getAccessToken($redirectUrl);

    $_SESSION['access_token'] = $accessToken;

    echo "<p>You are now connected</p><a href=\"index.php\">Back to menu</a>";
} else {
    echo sprintf('<a href="%s">Login with mailXpert</a>', $mailxpert->getLoginHelper()->getLoginUrl($redirectUrl));
}