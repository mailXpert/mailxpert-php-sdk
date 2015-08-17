<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\Authentication;


class AccessToken
{
    private $accessToken;
    private $expiresAt;
    private $refreshToken;

    /**
     * AccessToken constructor.
     *
     * @param $accessToken
     * @param $refreshToken
     * @param $expiresAt
     */
    public function __construct($accessToken, $refreshToken, $expiresAt)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresAt = $expiresAt;
    }

    public function getValue()
    {
        return $this->accessToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
}