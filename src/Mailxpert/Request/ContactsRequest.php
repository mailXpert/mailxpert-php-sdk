<?php

namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKResponseException;
use Mailxpert\Mailxpert;

/**
 * Class ContactsRequest
 * @package Mailxpert\Request
 */
class ContactsRequest
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
        $response = $mailxpert->sendRequest('GET', 'contacts', $params);

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during receiving Contacts.');
        }

        return $response;
    }
    /**
     * @param  Mailxpert $mailxpert
     * @param  int    $id
     * @param  array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function getOne(Mailxpert $mailxpert, $id, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', sprintf('contacts/%d', $id), $params);

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during receiving Contacts.');
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
        $response = $mailxpert->sendRequest('POST', 'contacts', [], null, json_encode($params));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Contact creation.');
        }

        return $response;
    }

    /**
     * @param  Mailxpert $mailxpert
     * @param  int    $id
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKResponseException
     */
    public static function subscribe(Mailxpert $mailxpert, $id)
    {
        $response = $mailxpert->sendRequest('PATCH', sprintf('contacts/%d/subscribe', $id));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Contact creation.');
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
        $response = $mailxpert->sendRequest('PATCH', sprintf('contacts/%s', $id), [], null, json_encode($params));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during updating the Contact.');
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
        $response = $mailxpert->sendRequest('DELETE', sprintf('contacts/%s', $id));

        if (!$response->isHttpResponseCodeOK()) {
            throw new MailxpertSDKResponseException($response, 'An error occured during the Contact deletion.');
        }

        return $response;
    }
}
