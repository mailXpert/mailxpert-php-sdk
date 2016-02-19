<?php

namespace Mailxpert\Model\CP;

/**
 * Class Address
 *
 * @package Mailxpert\Model\CP
 */
class Address
{
    const TITLE_FEMALE = 'female';
    const TITLE_MALE = 'male';

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
    private $firstname;

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
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $mobile;

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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
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
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @param array $exclude
     * @param bool  $clean
     *
     * @return array
     */
    public function toAPI(array $exclude = [], $clean = true)
    {
        $data = [
            "title" => $this->getTitle(),
            "company" => $this->getCompany(),
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "address" => $this->getAddress(),
            "address2" => $this->getAddress2(),
            "zip" => $this->getZip(),
            "city" => $this->getCity(),
            "country" => $this->getCountry(),
            "email" => $this->getEmail(),
            "phone" => $this->getPhone(),
            "mobile" => $this->getMobile(),
        ];

        if ($clean) {
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }
        }

        foreach ($exclude as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    /**
     * @param array $data
     */
    public function fromAPI(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "title":
                    $this->setTitle($value);
                    break;
                case "company":
                    $this->setCompany($value);
                    break;
                case "firstname":
                    $this->setFirstname($value);
                    break;
                case "lastname":
                    $this->setLastname($value);
                    break;
                case "address":
                    $this->setAddress($value);
                    break;
                case "address2":
                    $this->setAddress2($value);
                    break;
                case "zip":
                    $this->setZip($value);
                    break;
                case "city":
                    $this->setCity($value);
                    break;
                case "country":
                    $this->setCountry($value);
                    break;
                case "email":
                    $this->setEmail($value);
                    break;
                case "phone":
                    $this->setPhone($value);
                    break;
                case "mobile":
                    $this->setMobile($value);
                    break;
                default:
                    break;
            }
        }
    }
}
