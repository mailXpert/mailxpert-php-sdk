<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Model\ModelFactory;

class MailxpertResponse
{
    /**
     * @var MailxpertRequest
     */
    private $request;

    /**
     * @var string
     */
    private $body;

    /**
     * @var int
     */
    private $httpResponseCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var array
     */
    protected $decodedBody = [];

    /**
     * @var MailxpertSDKException
     */
    protected $thrownException;

    /**
     * MailxpertResponse constructor.
     *
     * @param MailxpertRequest $request
     * @param string           $body
     * @param int              $httpResponseCode
     * @param array            $headers
     */
    public function __construct(MailxpertRequest $request, $body = null, $httpResponseCode = null, array $headers = [])
    {
        $this->request = $request;
        $this->body = $body;
        $this->httpResponseCode = $httpResponseCode;
        $this->headers = $headers;

        $this->decodeBody();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->body;
    }

    /**
     * @return MailxpertRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return MailxpertApp
     */
    public function getApp()
    {
        return $this->request->getApp();
    }

    /**
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->request->getAccessToken();
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getHttpResponseCode()
    {
        return $this->httpResponseCode;
    }

    /**
     * @return bool
     */
    public function isHttpResponseCodeOK()
    {
        return (substr($this->httpResponseCode, 0, 1) == 2);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHeader($header)
    {
        return isset($this->headers[$header]) ? $this->headers[$header] : null;
    }

    public function decodeBody()
    {
        $decodedBody = json_decode($this->body, true);

        if (is_array($decodedBody)) {
            $this->decodedBody = $decodedBody;
        } elseif (is_numeric($decodedBody)) {
            $this->decodedBody = ['id' => $this->decodedBody];
        } elseif (is_null($decodedBody)) {
            $this->decodedBody = [];
            parse_str($this->body, $this->decodedBody);
        } else {
            $this->decodedBody = [];
        }

        if ($this->isError()) {
            $this->makeException();
        }
    }

    /**
     * @return array
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    public function getMailxpertNode()
    {
        return ModelFactory::getNode($this->getRequest()->getEndpoint(), $this->getDecodedBody());
    }

    /**
     * @return MailxpertSDKException
     */
    public function getThrownException()
    {
        return $this->thrownException;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return isset($this->decodedBody['error']);
    }

    public function makeException()
    {
        $this->thrownException = new MailxpertSDKException($this->decodedBody['error']);
    }
}