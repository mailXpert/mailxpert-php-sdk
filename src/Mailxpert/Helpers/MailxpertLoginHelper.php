<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\Helpers;

use Mailxpert\Authentication\AccessToken;
use Mailxpert\Authentication\OAuth2Client;

/**
 * Class MailxpertLoginHelper
 * @package Mailxpert\Helpers
 */
class MailxpertLoginHelper
{
    /**
     * @var OAuth2Client
     */
    private $oAuth2Client;

    /**
     * MailxpertRedirectLoginHelper constructor.
     *
     * @param OAuth2Client $oAuth2Client
     */
    public function __construct(OAuth2Client $oAuth2Client)
    {
        $this->oAuth2Client = $oAuth2Client;
    }

    /**
     * @param string $redirectUrl
     * @param array  $scope
     * @param string $separator
     *
     * @return string
     */
    public function getLoginUrl($redirectUrl, array $scope = [], $separator = '&')
    {
        return $this->makeUrl($redirectUrl, $scope, [], $separator);
    }

    /**
     * @param string $redirectUrl
     *
     * @return \Mailxpert\Authentication\AccessToken
     */
    public function getAccessToken($redirectUrl)
    {
        // TODO: CSRF

        return $this->oAuth2Client->getAccessTokenFromCode($this->getCode(), $redirectUrl);
    }

    /**
     * @param AccessToken $accessToken
     * @param string      $redirectUrl
     *
     * @return AccessToken
     */
    public function refreshAccessToken(AccessToken $accessToken, $redirectUrl)
    {
        return $this->oAuth2Client->getAccessTokenFromAccessToken($accessToken, $redirectUrl);
    }

    /**
     * Return the code.
     *
     * @return string|null
     */
    protected function getCode()
    {
        return $this->getInput('code');
    }

    /**
     * @param string $redirectUrl
     * @param array  $scope
     * @param array  $params
     * @param string $separator
     *
     * @return string
     */
    private function makeUrl($redirectUrl, array $scope, array $params, $separator = '&')
    {
        $state = null; // TODO: CSRF

        return $this->oAuth2Client->getAuthorizationUrl($redirectUrl, $state, $scope, $params, $separator);
    }

    /**
     * Returns a value from a GET param.
     *
     * @param string $key
     *
     * @return string|null
     */
    private function getInput($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
}
