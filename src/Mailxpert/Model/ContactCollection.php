<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;


class ContactCollection extends ArrayCollection
{
    /**
     * @param mixed $offset
     *
     * @return Contact|null
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param Contact $contact
     *
     * @return void
     */
    public function add($contact)
    {
        if (!$this->exists(
            function ($key, $element) use ($contact) {
                return $contact->getEmail() == $element->getEmail();
            }
        )
        ) {
            parent::add($contact);
        }
    }

    /**
     * @param $email
     *
     * @return Contact|null
     */
    public function findByEmail($email)
    {
        $contacts = $this->filter(function ($element) use ($email) {
            return $element->getEmail() == $email;
        });

        return $contacts->first();
    }
}