<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Request;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Mailxpert;

class CustomFieldsRequest
{
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'custom_fields', $params);

        return $response;
    }

    public static function post(Mailxpert $mailxpert, array $params)
    {
        $response = $mailxpert->sendRequest('POST', 'custom_fields', [], null, json_encode($params));

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKException('An error occured during the Custom field creation.');
        }

        return $response;
    }
}