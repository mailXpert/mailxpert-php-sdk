<?php

namespace Mailxpert\Model;

/**
 * Date: 19/08/15
 */
class ContactListCollection extends ArrayCollection
{
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