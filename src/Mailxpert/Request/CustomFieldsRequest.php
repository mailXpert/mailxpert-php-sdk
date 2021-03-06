<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Exceptions\MailxpertSDKResponseException;
use Mailxpert\Mailxpert;

/**
 * Class CustomFieldsRequest
 * @package Mailxpert\Request
 */
class CustomFieldsRequest
{
    /**
     * @param Mailxpert $mailxpert
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'custom_fields', $params);

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Custom field fetching.');
        }

        return $response;
    }

    /**
     * @param Mailxpert $mailxpert
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function post(Mailxpert $mailxpert, array $params)
    {
        $response = $mailxpert->sendRequest('POST', 'custom_fields', [], null, json_encode($params));

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Custom field creation.');
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
        $response = $mailxpert->sendRequest('PATCH', sprintf('custom_fields/%s', $id), [], null, json_encode($params));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during updating the CustomField.');
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
        $response = $mailxpert->sendRequest('DELETE', sprintf('custom_fields/%s', $id));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the CustomField deletion.');
        }

        return $response;
    }
}
