<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Request;


use Mailxpert\Mailxpert;

class ContactsRequest
{
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'contacts', $params);

        return $response;
    }
}