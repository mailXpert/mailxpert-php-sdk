<?php

namespace Mailxpert\Model;

/**
 * Date: 19/08/15
 */
class ContactList
{
    /**
     * @var string $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var bool $default
     */
    protected $default = false;

    /**
     * ContactList constructor.
     *
     * @param string $id
     * @param string $name
     * @param bool  $default
     */
    public function __construct($id, $name, $default)
    {
        $this->id = $id;
        $this->name = $name;
        $this->default = $default;
    }

    function __toString()
    {
        return (string) $this->getName();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }


    public function toAPI()
    {
        return [
            'name' => $this->getName()
        ];
    }
}