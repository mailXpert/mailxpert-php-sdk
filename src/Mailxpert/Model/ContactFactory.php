<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Class ContactFactory
 * @package Mailxpert\Model
 */
class ContactFactory extends Factory
{
    /**
     * @param mixed $data
     *
     * @return Contact|ContactCollection
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return ContactCollection
     */
    protected static function buildCollection($data)
    {
        $contacts = new ContactCollection();

        foreach ($data as $contactData) {
            $contact = static::buildElement($contactData);
            $contacts->add($contact);
        }

        return $contacts;
    }

    /**
     * @param $data
     *
     * @return Contact
     */
    protected static function buildElement($data)
    {
        $contact = new Contact($data['email'], $data['id']);
        $contact->fromAPI($data);

        return $contact;
    }
}
