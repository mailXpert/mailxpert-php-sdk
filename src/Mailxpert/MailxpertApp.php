<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert;

/**
 * Class MailxpertApp
 * @package Mailxpert
 */
class MailxpertApp
{
    /**
     * @var string The app ID.
     */
    private $id;

    /**
     * @var string The app secret.
     */
    private $secret;

    /**
     * @param string $id
     * @param string $secret
     */
    public function __construct($id, $secret)
    {
        $this->id = $id;
        $this->secret = $secret;
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
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([$this->id, $this->secret]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list($id, $secret) = unserialize($serialized);

        $this->__construct($id, $secret);
    }
}
