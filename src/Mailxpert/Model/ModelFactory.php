<?php

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

class ModelFactory
{
    public static function getFactory($endpoint)
    {
        $root = static::getRoot($endpoint);

        switch ($root) {
            case 'contact_lists':
                return '\\Mailxpert\\Model\\ContactListFactory';
            case 'contacts':
                return '\\Mailxpert\\Model\\ContactFactory';
            default:
                throw new MailxpertSDKException(sprintf('No model found for endpoint %s', $endpoint));
        }
    }

    private static function getRoot($endpoint)
    {
        while (strpos($endpoint, '/') === 0) {
            $endpoint = substr($endpoint, 1);
        }

        $path = explode('/', $endpoint);

        return array_shift($path);
    }

    public static function getNode($endpoint, $data)
    {
        $factory = static::getFactory($endpoint);

        return call_user_func([$factory, 'parse'], $data);
    }
}