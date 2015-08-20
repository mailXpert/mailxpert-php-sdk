<?php
/**
 * Date: 20/08/15
 */

namespace Mailxpert\Model;


class Contact
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var  \DateTime
     */
    private $subscribed;

    /**
     * @var \DateTime
     */
    private $unsubscribed;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var string
     */
    private $contactListId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $politeForm;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $firsname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $birthday;

    /**
     * @var array
     */
    private $customValues = [];

    /**
     * Contact constructor.
     *
     * @param string $id
     * @param string $hash
     * @param string $email
     */
    public function __construct($id, $hash, $email)
    {
        $this->id = $id;
        $this->hash = $hash;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return \DateTime
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * @param \DateTime|string $subscribed
     */
    public function setSubscribed($subscribed)
    {
        if (is_string($subscribed)) {
            $this->subscribed = new \DateTime($subscribed);
        } else {
            $this->subscribed = $subscribed;
        }
    }

    /**
     * @return \DateTime
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * @param \DateTime $unsubscribed
     */
    public function setUnsubscribed($unsubscribed)
    {
        if (is_string($unsubscribed)) {
            $this->unsubscribed = new \DateTime($unsubscribed);
        } else {
            $this->unsubscribed = $unsubscribed;
        }
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        if (is_string($created)) {
            $this->created = new \DateTime($created);
        } else {
            $this->created = $created;
        }
    }

    /**
     * @return string
     */
    public function getContactListId()
    {
        return $this->contactListId;
    }

    /**
     * @param string $contactListId
     */
    public function setContactListId($contactListId)
    {
        $this->contactListId = $contactListId;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getPoliteForm()
    {
        return $this->politeForm;
    }

    /**
     * @param string $politeForm
     */
    public function setPoliteForm($politeForm)
    {
        $this->politeForm = $politeForm;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getFirsname()
    {
        return $this->firsname;
    }

    /**
     * @param string $firsname
     */
    public function setFirsname($firsname)
    {
        $this->firsname = $firsname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return array
     */
    public function getCustomValues()
    {
        return $this->customValues;
    }

    /**
     * @param array $customValues
     */
    public function setCustomValues($customValues)
    {
        $this->customValues = $customValues;
    }

    public function toAPI()
    {
        return [
            "email" => $this->getEmail(),
            "contact_list_id" => $this->getContactListId(), 
            "language" => $this->getLanguage(), 
            "polite_form" => $this->getPoliteForm(),
            "title" => $this->getTitle(),
            "company" => $this->getCompany(),
            "firstname" => $this->getFirsname(),
            "lastname" => $this->getLastname(),
            "address" => $this->getAddress(),
            "address2" => $this->getAddress2(),
            "zip" => $this->getZip(),
            "city" => $this->getCity(),
            "country" => $this->getCountry(),
            "phone" => $this->getPhone(),
            "birthday" => $this->getBirthday(),
            "custom_values" => $this->getCustomValues()
        ];
    }
}