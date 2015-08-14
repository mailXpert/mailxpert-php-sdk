<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert;


use Mailxpert\Authentication\AccessToken;

class MailxpertRequest
{
    /**
     * @var MailxpertApp
     */
    private $app;
    private $accessToken;
    private $method;
    private $endpoint;
    private $params;
    protected $headers = [];

    /**
     * MailxpertRequest constructor.
     *
     * @param MailxpertApp       $app
     * @param AccessToken|string $accessToken
     * @param string             $method
     * @param string             $endpoint
     * @param array              $params
     */
    public function __construct(MailxpertApp $app, $accessToken, $method, $endpoint, $params)
    {
        $this->app = $app;
        $this->setAccessToken($accessToken);
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    /**
     * @return MailxpertApp
     */
    public function getApp()
    {
        return $this->app;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        if ($accessToken instanceof AccessToken) {
            $this->accessToken = $accessToken->getValue();
        }

        if (!is_null($this->accessToken)) {
            $this->headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getUrl()
    {
        $url = $this->endpoint;

        if ($this->getMethod() !== 'POST') {
            $url .= '?' . http_build_query($this->getParams(), null, '&');
        }

        return $url;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}