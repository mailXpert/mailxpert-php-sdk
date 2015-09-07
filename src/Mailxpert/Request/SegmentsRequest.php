<?php

namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKResponseException;
use Mailxpert\Mailxpert;

/**
 * Class SegmentsRequest
 * @package Mailxpert\Request
 */
class SegmentsRequest
{
    /**
     * @param  Mailxpert $mailxpert
     * @param  array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'segments', $params);

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during receiving Segments.');
        }

        return $response;
    }

    /**
     * @param  Mailxpert $mailxpert
     * @param  array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function post(Mailxpert $mailxpert, array $params)
    {
        $response = $mailxpert->sendRequest('POST', 'segments', [], null, json_encode($params));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Segments creation.');
        }

        return $response;
    }

    /**
     * @param  Mailxpert $mailxpert
     * @param  string    $id
     * @param  array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function patch(Mailxpert $mailxpert, $id, array $params)
    {
        $response = $mailxpert->sendRequest('PATCH', sprintf('segments/%s', $id), [], null, json_encode($params));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during updating the Segments.');
        }

        return $response;
    }

    /**
     * @param  Mailxpert $mailxpert
     * @param  string    $id
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function delete(Mailxpert $mailxpert, $id)
    {
        $response = $mailxpert->sendRequest('DELETE', sprintf('segments/%s', $id));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Segments deletion.');
        }

        return $response;
    }
}
