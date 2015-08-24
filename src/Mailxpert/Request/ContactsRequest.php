<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Mailxpert;

class ContactsRequest
{
    /**
     * @param Mailxpert $mailxpert
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'contacts', $params);

        return $response;
    }

    /**
     * @param  Mailxpert                    $mailxpert
     * @param  array                        $params
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKException
     */
    public static function post(Mailxpert $mailxpert, array $params)
    {
        $response = $mailxpert->sendRequest('POST', 'contacts', [], null, json_encode($params));

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKException('An error occured during the Contact creation.');
        }

        return $response;
    }

    /**
     * @param Mailxpert $mailxpert
     * @param string    $id
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function patch(Mailxpert $mailxpert, $id, array $params)
    {
        $response = $mailxpert->sendRequest('PATCH', sprintf('contacts/%s', $id), [], null, json_encode($params));

        return $response;
    }

    /**
     * @param Mailxpert $mailxpert
     * @param string    $id
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function delete(Mailxpert $mailxpert, $id)
    {
        $response = $mailxpert->sendRequest('DELETE', sprintf('contacts/%s', $id));

        return $response;
    }
}
