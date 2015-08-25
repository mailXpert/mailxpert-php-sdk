<?php

namespace Mailxpert\Exceptions;

use Exception;
use Mailxpert\MailxpertResponse;

/**
 * Class MailxpertSDKResponseException
 *
 * @package Mailxpert\Exceptions
 */
class MailxpertSDKResponseException extends MailxpertSDKException
{
    private $response;

    /**
     * @param MailxpertResponse $response
     * @param string            $message
     * @param int               $code
     * @param Exception|null    $previous
     */
    public function __construct(MailxpertResponse $response, $message = "", $code = 0, Exception $previous = null)
    {
        $this->response = $response;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return MailxpertResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
