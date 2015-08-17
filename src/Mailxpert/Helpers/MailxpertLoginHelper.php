<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\Helpers;


use Mailxpert\Authentication\AccessToken;
use Mailxpert\Authentication\OAuth2Client;

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

    public function getLoginUrl($redirectUrl, array $scope = [], $separator = '&')
    {
        return $this->makeUrl($redirectUrl, $scope, [], $separator);
    }

    private function makeUrl($redirectUrl, array $scope, array $params, $separator = '&')
    {
        $state = null; // TODO: CSRF

        return $this->oAuth2Client->getAuthorizationUrl($redirectUrl, $state, $scope, $params, $separator);
    }

    /**
     * @param $redirectUrl
     *
     * @return \Mailxpert\Authentication\AccessToken
     */
    public function getAccessToken($redirectUrl)
    {
        // TODO: CSRF

        return $this->oAuth2Client->getAccessTokenFromCode($this->getCode(), $redirectUrl);
    }

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