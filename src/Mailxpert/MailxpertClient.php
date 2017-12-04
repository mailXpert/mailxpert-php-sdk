<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert;

use Mailxpert\HttpClients\MailxpertCurlHttpClient;
use Mailxpert\HttpClients\MailxpertHttpClientInterface;
use Mailxpert\HttpClients\MailxpertStreamHttpClient;

/**
 * Class MailxpertClient
 * @package Mailxpert
 */
class MailxpertClient
{
    /**
     * @const string Production API URL.
     */
    const BASE_API_URL = 'https://api.mailxpert.ch';

    /**
     * @const string API Version
     */
    const API_VERSION = 'v2.0';

    /**
     * @const int The timeout in seconds for a normal request.
     */
    const DEFAULT_REQUEST_TIMEOUT = 60;

    /**
     * @var string|null
     */
    protected $apiBaseUrl;

    /**
     * @var MailxpertHttpClientInterface
     */
    protected $httpClientHandler;

    /**
     * @param MailxpertHttpClientInterface|null $httpClientHandler
     * @param string|null                       $apiBaseUrl
     */
    public function __construct(MailxpertHttpClientInterface $httpClientHandler = null, $apiBaseUrl = null)
    {
        $this->httpClientHandler = $httpClientHandler ?: $this->detectHttpClientHandler();

        if (is_null($apiBaseUrl)) {
            $apiBaseUrl = static::BASE_API_URL;
        }

        $this->apiBaseUrl = $apiBaseUrl;
    }

    /**
     * @param MailxpertHttpClientInterface $httpClientHandler
     */
    public function setHttpClientHandler(MailxpertHttpClientInterface $httpClientHandler)
    {
        $this->httpClientHandler = $httpClientHandler;
    }

    /**
     * @return MailxpertHttpClientInterface
     */
    public function getHttpClientHandler()
    {
        return $this->httpClientHandler;
    }

    /**
     * @return MailxpertCurlHttpClient|MailxpertStreamHttpClient
     */
    public function detectHttpClientHandler()
    {
        return function_exists('curl_init') ? new MailxpertCurlHttpClient() : new MailxpertStreamHttpClient();
    }

    /**
     * @return string
     */
    public function getAPIUrl()
    {
        return $this->apiBaseUrl.'/'.static::API_VERSION;
    }

    /**
     * @param MailxpertRequest $request
     *
     * @return MailxpertResponse
     * @throws Exceptions\MailxpertSDKException
     */
    public function sendRequest(MailxpertRequest $request)
    {
        list($url, $method, $headers, $body) = $this->prepareRequestMessage($request);

        $timeOut = static::DEFAULT_REQUEST_TIMEOUT;

        $rawResponse = $this->getHttpClientHandler()->send($url, $method, $body, $headers, $timeOut);

        $returnResponse = new MailxpertResponse(
            $request,
            $rawResponse->getBody(),
            $rawResponse->getHttpResponseCode(),
            $rawResponse->getHeaders()
        );

        if ($returnResponse->isError()) {
            throw $returnResponse->getThrownException();
        }

        return $returnResponse;
    }

    private function prepareRequestMessage(MailxpertRequest $request)
    {
        $url = $request->getEndpoint();

        if (strpos($url, 'http') !== 0) {
            $url = strpos($url, '/') === 0 ? $url : '/'.$url;
            $url = $this->getAPIUrl().$url;
        }

        if ($request->getParams()) {
            $url .= '?'.http_build_query($request->getParams(), null, '&');
        }

        $body = $request->getBody();

        return [
            $url,
            $request->getMethod(),
            $request->getHeaders(),
            $body,
        ];
    }
}
