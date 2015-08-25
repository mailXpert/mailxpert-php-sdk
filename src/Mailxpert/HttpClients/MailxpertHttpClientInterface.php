<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\HttpClients;

/**
 * Interface MailxpertHttpClientInterface
 * @package Mailxpert\HttpClients
 */
interface MailxpertHttpClientInterface
{
    /**
     * Sends a request to the server and returns the raw response.
     *
     * @param string $url     The endpoint to send the request to.
     * @param string $method  The request method.
     * @param string $body    The body of the request.
     * @param array  $headers The request headers.
     * @param int    $timeOut The timeout in seconds for the request.
     *
     * @return \Mailxpert\Http\RawResponse Raw response from the server.
     *
     * @throws \Mailxpert\Exceptions\MailxpertSDKException
     */
    public function send($url, $method, $body, array $headers, $timeOut);
}
