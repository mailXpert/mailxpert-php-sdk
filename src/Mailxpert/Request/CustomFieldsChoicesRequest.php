<?php
/**
 * Date: 21/08/15
 */

namespace Mailxpert\Request;


use Mailxpert\Mailxpert;

class CustomFieldsChoicesRequest
{
    public static function get(Mailxpert $mailxpert, $customFieldId, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', sprintf('custom_fields/%s/choices', $customFieldId), $params);

        return $response;
    }
}