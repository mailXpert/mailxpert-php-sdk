<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Mailxpert;

/**
 * Class CustomFieldsChoicesRequest
 * @package Mailxpert\Request
 */
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
        $response = $mailxpert->sendRequest('POST', sprintf('custom_fields/%s/choices', $customFieldId), [], null, json_encode($params));

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKException('An error occured during the Contactfield Choice creation.');
        }

        return $response;
    }
}
