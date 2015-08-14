<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\HttpClients;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Http\RawResponse;

class MailxpertStreamHttpClient implements MailxpertHttpClientInterface
{
    /**
     * @var MailxpertStream Procedural stream wrapper as object.
     */
    protected $mailxpertStream;

    /**
     * @param MailxpertStream|null Procedural stream wrapper as object.
     */
    public function __construct(MailxpertStream $mailxpertStream = null)
    {
        $this->mailxpertStream = $mailxpertStream ?: new MailxpertStream();
    }

    /**
     * @inheritdoc
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $options = [
            'http' => [
                'method' => $method,
                'header' => $this->compileHeader($headers),
                'content' => $body,
                'timeout' => $timeOut,
                'ignore_errors' => true
            ],
        ];

        $this->mailxpertStream->streamContextCreate($options);
        $rawBody = $this->mailxpertStream->fileGetContents($url);
        $rawHeaders = $this->mailxpertStream->getResponseHeaders();

        if ($rawBody === false || !$rawHeaders) {
            throw new MailxpertSDKException('Stream returned an empty response', 660);
        }

        $rawHeaders = implode("\r\n", $rawHeaders);

        return new RawResponse($rawHeaders, $rawBody);
    }

    /**
     * Formats the headers for use in the stream wrapper.
     *
     * @param array $headers The request headers.
     *
     * @return string
     */
    public function compileHeader(array $headers)
    {
        $header = [];
        foreach ($headers as $k => $v) {
            $header[] = $k . ': ' . $v;
        }

        return implode("\r\n", $header);
    }
}