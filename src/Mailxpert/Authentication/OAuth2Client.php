<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\Authentication;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\MailxpertApp;
use Mailxpert\MailxpertClient;
use Mailxpert\MailxpertRequest;

class OAuth2Client
{
    const BASE_AUTHORIZATION_URL = 'https://v5.mailxpert.ch';

    /**
     * @var MailxpertApp
     */
    private $app;

    /**
     * @var MailxpertClient
     */
    private $client;

    /**
     * @var
     */
    private $baseAuthorizationUrl;

    /**
     * @var MailxpertRequest
     */
    private $lastRequest;

    /**
     * OAuth2Client constructor.
     *
     * @param MailxpertApp    $mailxpertApp
     * @param MailxpertClient $mailxpertClient
     * @param string          $baseAuthorizationUrl
     */
    public function __construct(MailxpertApp $mailxpertApp, MailxpertClient $mailxpertClient, $baseAuthorizationUrl = null)
    {
        $this->app = $mailxpertApp;
        $this->client = $mailxpertClient;
        if (is_null($baseAuthorizationUrl)) {
            $baseAuthorizationUrl = static::BASE_AUTHORIZATION_URL;
        }
        $this->baseAuthorizationUrl = $baseAuthorizationUrl;
    }

    /**
     * @param $redirectUrl
     * @param $state
     * @param $scope
     * @param $params
     * @param $separator
     *
     * @return string
     */
    public function getAuthorizationUrl($redirectUrl, $state, $scope, $params, $separator)
    {
        $params += [
            'client_id' => $this->app->getId(),
            'response_type' => 'code',
            'redirect_uri' => $redirectUrl,
            'scope' => implode(',', $scope)
        ];

        return $this->baseAuthorizationUrl . '/oauth/v2/auth?' . http_build_query($params, null, $separator);
    }

    /**
     * @param $code
     * @param $redirectUrl
     *
     * @return AccessToken
     * @throws MailxpertSDKException
     */
    public function getAccessTokenFromCode($code, $redirectUrl)
    {
        $params = [
            'code' => $code,
            'redirect_uri' => $redirectUrl,
            'grant_type' => 'authorization_code',
        ];

        return $this->requestAccessToken($params);
    }

    /**
     * @param array $params
     *
     * @return AccessToken
     * @throws MailxpertSDKException
     */
    protected function requestAccessToken(array $params)
    {
        $response = $this->sendRequestWithClientsParams('/oauth/v2/token', $params);

        $data = $response->getDecodedBody();

        if (!isset($data['access_token'])) {
            throw new MailxpertSDKException('Access token was not returned.', 401);
        }

        $expiresAt = 0;
        if (isset($data['expires'])) {
            $expiresAt = time() + $data['expires'];
        } elseif (isset($data['expires_in'])) {
            $expiresAt = time() + $data['expires_in'];
        }

        return new AccessToken($data['access_token'], $data['refresh_token'], $expiresAt);
    }

    /**
     * @param $endpoint
     * @param $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    private function sendRequestWithClientsParams($endpoint, $params)
    {
        $params += $this->getClientParams();

        $this->lastRequest = new MailxpertRequest(
            $this->app,
            null, // ACCESS TOKEN
            'GET',
            $this->baseAuthorizationUrl . $endpoint,
            $params
        );


        return $this->client->sendRequest($this->lastRequest);
    }

    /**
     * @return array
     */
    private function getClientParams()
    {
        return [
            'client_id' => $this->app->getId(),
            'client_secret' => $this->app->getSecret(),
        ];
    }
}