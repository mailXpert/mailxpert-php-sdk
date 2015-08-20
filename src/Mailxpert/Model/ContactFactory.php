<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;


use Mailxpert\Exceptions\MailxpertSDKException;

class ContactFactory extends Factory
{
    /**
     * @param $data
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
        $contact = new Contact($data['id'], $data['hash'], $data['email']);

        foreach ($data as $key => $value) {
            switch ($key) {
                case "contact_list_id":
                    $contact->setContactListId($value);
                    break;
                case "language":
                    $contact->setLanguage($value);
                    break;
                case "polite_form":
                    $contact->setPoliteForm($value);
                    break;
                case "title":
                    $contact->setTitle($value);
                    break;
                case "company":
                    $contact->setCompany($value);
                    break;
                case "firstname":
                    $contact->setFirsname($value);
                    break;
                case "lastname":
                    $contact->setLastname($value);
                    break;
                case "address":
                    $contact->setAddress($value);
                    break;
                case "address2":
                    $contact->setAddress2($value);
                    break;
                case "zip":
                    $contact->setZip($value);
                    break;
                case "city":
                    $contact->setCity($value);
                    break;
                case "country":
                    $contact->setCountry($value);
                    break;
                case "phone":
                    $contact->setPhone($value);
                    break;
                case "birthday":
                    $contact->setBirthday($value);
                    break;
                case "custom_values":
                    $contact->setCustomValues($value);
                    break;
                case "subscribed":
                    $contact->setSubscribed($value);
                    break;
                case "unsubscribed":
                    $contact->setUnsubscribed($value);
                    break;
                case "created":
                    $contact->setCreated($value);
                    break;
                default:
                    break;
            }
        }

        return $contact;
    }
}