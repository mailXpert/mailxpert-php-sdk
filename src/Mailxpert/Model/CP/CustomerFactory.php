<?php

namespace Mailxpert\Model\CP;


use Mailxpert\Exceptions\MailxpertSDKException;
use Mailxpert\Model\Factory;

/**
 * Class CustomerFactory
 *
 * @package Mailxpert\Model\CP
 */
class CustomerFactory extends Factory
{
    /**
     * @param mixed $data
     *
     * @return Customer|CustomerCollection
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        if (isset($data['data']['password'])) {
            return self::buildCredential($data['data']);
        }

        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return CustomerCollection
     */
    protected static function buildCollection($data)
    {
        $customers = new CustomerCollection();

        foreach ($data as $customerData) {
            $customer = static::buildElement($customerData);
            $customers->add($customer);
        }

        return $customers;
    }

    /**
     * @param $data
     *
     * @return Customer
     */
    protected static function buildElement($data)
    {
        $customer = new Customer($data['id']);
        $customer->fromAPI($data);

        return $customer;
    }

    /**
     * @param $data
     *
     * @return Credential
     */
    protected static function buildCredential($data)
    {
        $credential = new Credential();
        $credential->fromAPI($data);

        return $credential;
    }
}