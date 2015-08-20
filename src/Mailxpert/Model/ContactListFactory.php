<?php

namespace Mailxpert\Model;

use Mailxpert\Exceptions\MailxpertSDKException;

/**
 * Date: 19/08/15
 */
class ContactListFactory
{
    /**
     * @param $data
     *
     * @return ContactList|ContactListCollection
     * @throws MailxpertSDKException
     */
    public static function parse($data)
    {
        if (!isset($data['data'])) {
            throw new MailxpertSDKException('The $data is invalid, it should at least contain a data field.');
        }

        if (isset($data['data']['id'])) {
            $element = static::buildElement($data['data']);
        } else {
            $element = static::buildCollection($data['data']);
        }

        return $element;
    }

    /**
     * @param $data
     *
     * @return ContactListCollection
     */
    private static function buildCollection($data)
    {
        $contactLists = new ContactListCollection();

        foreach ($data as $contactListData) {

            $contactList = new ContactList($contactListData['id'], $contactListData['name'], $contactListData['default']);

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
    private static function buildElement($data)
    {
        return new ContactList($data['id'], $data['name'], $data['default']);
    }

}