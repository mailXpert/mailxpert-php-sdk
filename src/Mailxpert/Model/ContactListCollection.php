<?php

namespace Mailxpert\Model;

/**
 * Date: 19/08/15
 */
class ContactListCollection extends ArrayCollection
{
    /**
     * @param ContactList $contactList
     *
     * @return void
     */
    public function add($contactList)
    {
        if (!$this->exists(function ($key, $element) use ($contactList) {
            return $contactList->getId() == $element->getId();
        })) {
            parent::add($contactList);
        }
    }

    /**
     * @param $name
     *
     * @return self
     */
    public function findByName($name)
    {
        return $this->filter(function ($element) use ($name) {
           return $element->getName() == $name;
        });
    }

    public function findOneByName($name)
    {
        $elements = $this->findByName($name);

        return $elements->first();
    }
}