<?php

namespace Mailxpert\Model\CP;


/**
 * Class SubscriptionOption
 *
 * @package Mailxpert\Model\CP
 */
class SubscriptionOption
{
    /**
     * @var string
     */
    private $id;

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
     * @var array|string
     */
    private $value;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return array|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
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
            "type_id" => $this->getTypeId(),
            "start" => $this->getStart() ? $this->getStart()->format('Y-m-d') : null,
            "end" => $this->getEnd() ? $this->getEnd()->format('Y-m-d') : null,
            "value" => $this->getValue()
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
                case "value":
                    $this->setValue($value);
                    break;
                default:
                    break;
            }
        }
    }
}
