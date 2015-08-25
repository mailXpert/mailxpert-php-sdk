<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Class Factory
 * @package Mailxpert\Model
 */
abstract class Factory implements FactoryInterface
{
    /**
     * @param mixed $data
     *
     * @return mixed
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        if (!isset($data['data'])) {
            throw new MailxpertSDKException('The $data is invalid, it should at least contain a data field.');
        }

        if (isset($data['data']['id'])) {
            $element = static::buildElement($data['data']);
        } else {
            $element = static::buildCollection($data['data']);
        }

        return $element;
    }


    /**
     * Build collection of elements
     *
     * @param $data
     *
     * @return mixed
     * @throws MailxpertSDKException
     */
    protected static function buildCollection($data)
    {
        throw new MailxpertSDKException('Method not implemented');
    }

    /**
     * Build element
     *
     * @param $data
     *
     * @return mixed
     * @throws MailxpertSDKException
     */
    protected static function buildElement($data)
    {
        throw new MailxpertSDKException('Method not implemented');
    }
}
