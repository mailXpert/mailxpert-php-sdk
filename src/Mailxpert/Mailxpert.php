<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert;


use Mailxpert\Authentication\AccessToken;
use Mailxpert\Authentication\OAuth2Client;
use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Helpers\MailxpertLoginHelper;

class Mailxpert
{
    /**
     * @const string The name of the environment variable that contains the app ID.
     */
    const APP_ID_ENV_NAME = 'MAILXPERT_APP_ID';

    /**
     * @const string The name of the environment variable that contains the app secret.
     */
    const APP_SECRET_ENV_NAME = 'MAILXPERT_APP_SECRET';

    /**
     * @var MailxpertApp
     */
    protected $app;

    /**
     * @var MailxpertClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $oauthBaseUrl;

    /**
     * @var string
     */
    protected $apiBaseUrl;

    /**
     * @var OAuth2Client
     */
    protected $oAuth2Client;

    /**
     * @var MailxpertResponse
     */
    protected $lastResponse;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    public function __construct(array $config = [])
    {
        $appId = isset($config['app_id']) ? $config['app_id'] : getenv(static::APP_ID_ENV_NAME);
        if (!$appId) {
            throw new MailxpertSDKException('Required "app_id" key not supplied in config and could not find fallback environment variable "' . static::APP_ID_ENV_NAME . '"');
        }

        $appSecret = isset($config['app_secret']) ? $config['app_secret'] : getenv(static::APP_SECRET_ENV_NAME);
        if (!$appSecret) {
            throw new MailxpertSDKException('Required "app_secret" key not supplied in config and could not find fallback environment variable "' . static::APP_SECRET_ENV_NAME . '"');
        }

        $this->app = new MailxpertApp($appId, $appSecret);

        if (isset($config['api_base_url'])) {
            $this->apiBaseUrl = $config['api_base_url'];
        }

        $this->client = new MailxpertClient(null, $this->apiBaseUrl);

        if (isset($config['oauth_base_url'])) {
            $this->oauthBaseUrl = $config['oauth_base_url'];
        }

        if (isset($config['access_token']) && $config['access_token'] instanceof AccessToken) {
            $this->accessToken = $config['access_token'];
        }
    }

    /**
     * @return MailxpertApp
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @return MailxpertClient
     */
    public function getClient()
    {
        return $this->client;
    }

    public function getLoginHelper()
    {
        return new MailxpertLoginHelper(
            $this->getOAuth2Client()
        );
    }

    public function sendRequest($method, $endpoint, array $params = [], $accessToken = null)
    {
        $accessToken = $accessToken?$accessToken:$this->accessToken;

        $request = $this->request($method, $endpoint, $params, $accessToken);

        return $this->lastResponse = $this->client->sendRequest($request);
    }

    public function request($method, $endpoint, array $params = [], $accessToken = null)
    {
        return new MailxpertRequest(
            $this->app,
            $accessToken,
            $method,
            $endpoint,
            $params
        );
    }

    /**
     * @param AccessToken $accessToken
     */
    public function setAccessToken(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    private function getOAuth2Client()
    {
        if (!$this->oAuth2Client instanceof OAuth2Client) {
            $app = $this->getApp();
            $client = $this->getClient();
            $this->oAuth2Client = new OAuth2Client($app, $client, $this->oauthBaseUrl);
        }

        return $this->oAuth2Client;
    }
}