<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;


class ContactCollection extends ArrayCollection
{
    /**
     * @param Contact $contact
     *
     * @return void
     */
    public function add($contact)
    {
        if (!$this->exists(
            function ($key, $element) use ($contact) {
                return $contact->getId() == $element->getId();
            }
        )
        ) {
            parent::add($contact);
        }
    }
}