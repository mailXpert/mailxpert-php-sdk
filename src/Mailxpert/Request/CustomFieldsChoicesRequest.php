<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Request;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Mailxpert;

class CustomFieldsChoicesRequest
{
    /**
     * @param Mailxpert $mailxpert
     * @param string    $customFieldId
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function get(Mailxpert $mailxpert, $customFieldId, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', sprintf('custom_fields/%s/choices', $customFieldId), $params);

        return $response;
    }

    /**
     * @param Mailxpert $mailxpert
     * @param string    $customFieldId
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKException
     */
    public static function post(Mailxpert $mailxpert, $customFieldId, array $params)
    {
        $response = $mailxpert->sendRequest('GET', sprintf('custom_fields/%s/choices', $customFieldId), $params);

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKException('An error occured during the Contact creation.');
        }

        return $response;
    }
}
