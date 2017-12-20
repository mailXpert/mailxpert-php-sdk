<?php

namespace Mailxpert\Model\CP;


/**
 * Class Customer
 *
 * @package Mailxpert\Model\CP
 */
class Customer
{
    const STATUS_NOT_YET_STARTED = 'not_yet_started';
    const STATUS_DEACTIVATED = 'deactivated';
    const STATUS_EXPIRED = 'expired';
    const STATUS_ACTIVE = 'active';
    const STATUS_INITIALIZING = 'initializing';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $sector;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * @var Address
     */
    private $contactAddress;

    /**
     * @var Address
     */
    private $billingAddress;

    /**
     * Customer constructor.
     *
     * @param string $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     */
    public function setLastLogin(\DateTime $lastLogin = null)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     */
    public function setSubscription(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @return Address
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * @param Address $contactAddress
     */
    public function setContactAddress(Address $contactAddress)
    {
        $this->contactAddress = $contactAddress;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param Address $billingAddress
     */
    public function setBillingAddress(Address $billingAddress = null)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @param array $exclude
     * @param bool  $clean
     *
     * @return array
     */
    public function toAPI(array $exclude = [], $clean = true)
    {
        $data = [
            "customer_name" => $this->getCustomerName(),
            "sector" => $this->getSector(),
            "subscription" => $this->getSubscription() ? $this->getSubscription()->toAPI($exclude, $clean) : null,
            "contact_address" => $this->getContactAddress() ? $this->getContactAddress()->toAPI($exclude, $clean) : null,
            "billing_address" => $this->getBillingAddress() ? $this->getBillingAddress()->toAPI($exclude, $clean) : null,
        ];

        if ($clean) {
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }
        }

        foreach ($exclude as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    /**
     * @param array $data
     */
    public function fromAPI(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "customer_name":
                    $this->setCustomerName($value);
                    break;
                case "status":
                    $this->setStatus($value);
                    break;
                case "sector":
                    $this->setSector($value);
                    break;
                case "subscription":
                    $this->setSubscription($subscription = new Subscription());
                    $subscription->fromAPI($value);
                    break;
                case "contact_address":
                    $this->setContactAddress($address = new Address());
                    $address->fromAPI($value);
                    break;
                case "billing_address":
                    $this->setBillingAddress($address = new Address());
                    $address->fromAPI($value);
                    break;
                case "created":
                    $this->setCreated(new \DateTime($value));
                    break;
                case "last_login":
                    $this->setLastLogin($value ? new \DateTime($value) : null);
                    break;
                default:
                    break;
            }
        }
    }
}
