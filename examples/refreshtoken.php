<?php

$accessToken = $mailxpert->getLoginHelper()->refreshAccessToken($mailxpert->getAccessToken(), $redirectUrl);

$_SESSION['access_token'] = $accessToken;

echo "<p>Access token refreshed</p><a href=\"index.php\">Back to menu</a>";