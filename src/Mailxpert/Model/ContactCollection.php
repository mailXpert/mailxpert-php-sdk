<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;

/**
 * Class ContactCollection
 * @package Mailxpert\Model
 */
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
            function ($key, Contact $element) use ($contact) {
                return $contact->getEmail() == $element->getEmail();
            }
        )
        ) {
            parent::add($contact);
        }
    }

    /**
     * @param string $email
     *
     * @return Contact|null
     */
    public function findByEmail($email)
    {
        $contacts = $this->filter(function (Contact $element) use ($email) {
            return $element->getEmail() == strtolower($email);
        });

        return $contacts->first();
    }
}
