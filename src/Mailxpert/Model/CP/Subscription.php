<?php

namespace Mailxpert\Model\CP;


/**
 * Class Subscription
 *
 * @package Mailxpert\Model\CP
 */
class Subscription
{
    /**
     * @var int
     */
    private $typeId;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var array
     */
    private $appLanguages;

    /**
     * @var array
     */
    private $contactLanguages;

    /**
     * @var string
     */
    private $contactDomain;

    /**
     * @var int
     */
    private $parentCustomerId;

    /**
     * @var SubscriptionOption[]
     */
    private $options = [];


    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end = null)
    {
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getAppLanguages()
    {
        return $this->appLanguages;
    }

    /**
     * @param array $appLanguages
     */
    public function setAppLanguages(array $appLanguages)
    {
        $this->appLanguages = $appLanguages;
    }

    /**
     * @return array
     */
    public function getContactLanguages()
    {
        return $this->contactLanguages;
    }

    /**
     * @param array $contactLanguages
     */
    public function setContactLanguages(array $contactLanguages)
    {
        $this->contactLanguages = $contactLanguages;
    }

    /**
     * @return array
     */
    public function getContactDomain()
    {
        return $this->contactDomain;
    }

    /**
     * @param string $contactDomain
     */
    public function setContactDomain($contactDomain)
    {
        $this->contactDomain = $contactDomain;
    }

    /**
     * @return int
     */
    public function getParentCustomerId()
    {
        return $this->parentCustomerId;
    }

    /**
     * @param int $parentCustomerId
     */
    public function setParentCustomerId($parentCustomerId)
    {
        $this->parentCustomerId = $parentCustomerId;
    }

    /**
     * @return SubscriptionOption[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param SubscriptionOption $option
     */
    public function addOption(SubscriptionOption $option)
    {
        $this->options[] = $option;
    }

    /**
     * @param SubscriptionOption[] $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param array $exclude
     * @param bool  $clean
     *
     * @return array
     */
    public function toAPI(array $exclude = [], $clean = true)
    {
        $options = [];

        foreach($this->getOptions() as $option) {
            $options[] = $option->toAPI($exclude, $clean);
        }

        $data = [
            "type_id" => $this->getTypeId(),
            "start" => $this->getStart() ? $this->getStart()->format('Y-m-d') : null,
            "end" => $this->getEnd() ? $this->getEnd()->format('Y-m-d'): null,
            "app_languages" => $this->getAppLanguages(),
            "contact_languages" => $this->getContactLanguages(),
            "contact_domain" => $this->getContactDomain(),
            "parent_customer_id" => $this->getParentCustomerId(),
            "options" => $options
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
                case "type_id":
                    $this->setTypeId($value);
                    break;
                case "start":
                    $this->setStart(new \DateTime($value));
                    break;
                case "end":
                    $this->setEnd($value ? new \DateTime($value) : null);
                    break;
                case "app_languages":
                    $this->setAppLanguages($value);
                    break;
                case "contact_languages":
                    $this->setContactLanguages($value);
                    break;
                case "contact_domain":
                    $this->setContactDomain($value);
                    break;
                case "parent_customer_id":
                    $this->setParentCustomerId($value);
                    break;
                case "options":
                    foreach($value as $optionData) {
                        $this->addOption($option = new SubscriptionOption($optionData['id']));
                        $option->fromAPI($optionData);
                    }
                    break;
                default:
                    break;
            }
        }
    }
}
