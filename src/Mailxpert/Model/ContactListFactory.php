<?php

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Date: 19/08/15
 */
class ContactListFactory extends Factory
{
    /**
     * @param $data
     *
     * @return ContactList|ContactListCollection
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        return parent::parse($data);
    }

    /**
     * @param $data
     *
     * @return ContactListCollection
     */
    protected static function buildCollection($data)
    {
        $contactLists = new ContactListCollection();

        foreach ($data as $contactListData) {

            $contactList = static::buildElement($contactListData);

            if (!$contactLists->exists(function ($key, $element) use ($contactList) {
                return $contactList->getId() == $element->getId();
            })) {
                $contactLists->add($contactList);
            }
        }

        return $contactLists;
    }

    /**
     * @param $data
     *
     * @return ContactList
     */
    protected static function buildElement($data)
    {
        return new ContactList($data['id'], $data['name'], $data['default']);
    }
}