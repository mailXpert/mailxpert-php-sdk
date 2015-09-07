<?php

namespace Mailxpert\Model;

/**
 * Class Segment
 * @package Mailxpert\Model
 */
class Segment
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $contactListId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cql;

    /**
     * Segment constructor.
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
    public function __toString()
    {
        return (string) $this->getId();
    }


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContactListId()
    {
        return $this->contactListId;
    }

    /**
     * @param string $contactListId
     */
    public function setContactListId($contactListId)
    {
        $this->contactListId = $contactListId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCql()
    {
        return $this->cql;
    }

    /**
     * @param string $cql
     */
    public function setCql($cql)
    {
        $this->cql = $cql;
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
            "contact_list_id" => $this->getContactListId(),
            "name" => $this->getName(),
            "cql" => $this->getCql(),
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
                case "contact_list_id":
                    $this->setContactListId($value);
                    break;
                case "name":
                    $this->setName($value);
                    break;
                case "cql":
                    $this->setCql($value);
                    break;
                default:
                    break;
            }
        }
    }
}
