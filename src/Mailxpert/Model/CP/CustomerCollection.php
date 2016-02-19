<?php

namespace Mailxpert\Model\CP;

use Mailxpert\Model\ArrayCollection;

/**
 * Class CustomerCollection
 *
 * @package Mailxpert\Model
 */
class CustomerCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return Customer|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param Customer $customer
     *
     * @return void
     */
    public function add($customer)
    {
        if (!$this->exists(
            function ($key, Customer $element) use ($customer) {
                return $customer->getCustomerName() == $element->getCustomerName();
            }
        )
        ) {
            parent::add($customer);
        }
    }

    /**
     * @param string $customerName
     *
     * @return Customer|null
     */
    public function findByCustomerName($customerName)
    {
        $customers = $this->filter(
            function (Customer $element) use ($customerName) {
                return $element->getCustomerName() == $customerName;
            }
        );

        return $customers->first();
    }
}
