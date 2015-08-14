<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\HttpClients;

/**
 * Class MailxpertStream
 *
 * @package Mailxpert\HttpClients
 */
class MailxpertStream
{
    /**
     * @var resource Context stream resource instance
     */
    protected $stream;

    /**
     * @var array Response headers from the stream wrapper
     */
    protected $responseHeaders;

    /**
     * Make a new context stream reference instance
     *
     * @param array $options
     */
    public function streamContextCreate(array $options)
    {
        $this->stream = stream_context_create($options);
    }

    /**
     * The response headers from the stream wrapper
     *
     * @return array|null
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Send a stream wrapped request
     *
     * @param string $url
     *
     * @return mixed
     */
    public function fileGetContents($url)
    {
        $rawResponse = file_get_contents($url, false, $this->stream);
        $this->responseHeaders = $http_response_header;

        return $rawResponse;
    }
}