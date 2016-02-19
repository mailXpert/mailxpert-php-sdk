<?php

namespace Mailxpert\Model\CP;

/**
 * Class Credential
 *
 * @package Mailxpert\Model\CP
 */
class Credential
{
    /**
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $cpUserName;

    /**
     * @var string
     */
    private $cpPassword;

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getCpUserName()
    {
        return $this->cpUserName;
    }

    /**
     * @param string $cpUserName
     */
    public function setCpUserName($cpUserName)
    {
        $this->cpUserName = $cpUserName;
    }

    /**
     * @return string
     */
    public function getCpPassword()
    {
        return $this->cpPassword;
    }

    /**
     * @param string $cpPassword
     */
    public function setCpPassword($cpPassword)
    {
        $this->cpPassword = $cpPassword;
    }

    /**
     * @param array $data
     */
    public function fromAPI(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "customer_name":
                    $this->setCustomerName($value);
                    break;
                case "user_name":
                    $this->setUserName($value);
                    break;
                case "password":
                    $this->setPassword($value);
                    break;
                case "cp_user_name":
                    $this->setCpUserName($value);
                    break;
                case "cp_password":
                    $this->setCpPassword($value);
                    break;
            }
        }
    }
}
