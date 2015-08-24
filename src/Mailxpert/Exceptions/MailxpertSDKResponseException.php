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
