<?php

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\MailxpertClient;

class ModelFactory
{
    public static function getFactory($endpoint)
    {
        $endpoint = static::cleanEndpoint($endpoint);

        switch ($endpoint) {
            case (preg_match('/^(\/|)contact_lists(\/{1}[\w\{\}]*|)$/', $endpoint)?$endpoint:!$endpoint):
                return '\\Mailxpert\\Model\\ContactListFactory';
            case (preg_match('/^(\/|)contacts(\/{1}[\w\{\}]*|)$/', $endpoint)?$endpoint:!$endpoint):
                return '\\Mailxpert\\Model\\ContactFactory';
            case (preg_match('/^(\/|)custom_fields(\/{1}[\w\{\}]*|)$/', $endpoint)?$endpoint:!$endpoint):
                return '\\Mailxpert\\Model\\CustomFieldFactory';
            case (preg_match('/^(\/|)custom_fields(\/{1}[\w\{\}]*|)\/choices(\/{1}[\w\{\}]*|)$/', $endpoint) ? $endpoint : ! $endpoint):
                return '\\Mailxpert\\Model\\CustomFieldChoiceFactory';
            default:
                throw new MailxpertSDKException(sprintf('No model found for endpoint %s', $endpoint));
        }
    }

    public static function cleanEndpoint($endpoint)
    {
        if ((strpos($endpoint, 'http') === 0) && (strpos($endpoint, MailxpertClient::API_VERSION) !== false)) {
            $parts = explode('/', $endpoint);

            if (in_array(MailxpertClient::API_VERSION, $parts)) {
                while (in_array(MailxpertClient::API_VERSION, $parts)) {
                    array_shift($parts);
                }
            }

            return implode('/', $parts);
        }

        return $endpoint;
    }

    public static function getNode($endpoint, $data)
    {
        $factory = static::getFactory($endpoint);

        return call_user_func([$factory, 'parse'], $data);
    }
}