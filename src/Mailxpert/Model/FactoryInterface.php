<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Interface FactoryInterface
 * @package Mailxpert\Model
 */
interface FactoryInterface
{
    /**
     * Parse data from an API Request
     *
     * @param mixed $data
     *
     * @return mixed
     * @throws MailxpertSDKException
     */
    public static function parse($data);
}
