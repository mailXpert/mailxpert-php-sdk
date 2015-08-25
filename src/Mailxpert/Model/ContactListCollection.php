<?php

namespace Mailxpert\Model;

/**
 * Date: 19/08/15
 */
class ContactListCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return ContactList|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param ContactList $contactList
     *
     * @return void
     */
    public function add($contactList)
    {
        if (!$this->exists(
            function ($key, ContactList $element) use ($contactList) {
                return $contactList->getId() == $element->getId();
            }
        )
        ) {
            parent::add($contactList);
        }
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function findByName($name)
    {
        return $this->filter(
            function (ContactList $element) use ($name) {
                return $element->getName() == $name;
            }
        );
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findOneByName($name)
    {
        $elements = $this->findByName($name);

        return $elements->first();
    }
}
