<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Request;


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
     * @param Mailxpert $mailxpert
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function post(Mailxpert $mailxpert, array $params)
    {
        $response = $mailxpert->sendRequest('POST', 'contacts', [], null, json_encode($params));

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
}