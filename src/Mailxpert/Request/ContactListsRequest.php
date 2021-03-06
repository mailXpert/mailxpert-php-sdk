<?php
namespace Mailxpert\Request;

use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Mailxpert;

/**
 * Date: 20/08/15
 */
class ContactListsRequest
{
    /**
     * @param Mailxpert $mailxpert
     * @param array     $params
     *
     * @return \Mailxpert\MailxpertResponse
     */
    public static function get(Mailxpert $mailxpert, array $params = [])
    {
        $response = $mailxpert->sendRequest('GET', 'contact_lists', $params);

        return $response;
    }

    /**
     * @param Mailxpert $mailxpert
     * @param string    $name
     *
     * @return \Mailxpert\MailxpertResponse
     * @throws MailxpertSDKException
     */
    public static function post(Mailxpert $mailxpert, $name)
    {
        $response = $mailxpert->sendRequest('POST', 'contact_lists', [], null, json_encode(['name' => $name]));

        if (!$response->getHeader('Location')) {
            throw new MailxpertSDKException('An error occured during the Contact list creation.');
        }

        return $response;
    }
}
