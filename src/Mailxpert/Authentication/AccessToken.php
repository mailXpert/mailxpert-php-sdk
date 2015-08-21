<?php
/**
 * sources.
 * Date: 14/08/15
 */

namespace Mailxpert\Authentication;


class AccessToken
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var int
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $refreshTokenExpiresAt;

    /**
     * @var string
     */
    private $scope;

    /**
     * AccessToken constructor.
     *
     * @param string      $accessToken
     * @param string      $refreshToken
     * @param string      $expiresAt
     * @param string|null $scope
     * @param int         $refreshTokenExpireAt
     */
    public function __construct($accessToken, $refreshToken, $expiresAt, $scope = null, $refreshTokenExpireAt = 0)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresAt = (int) $expiresAt;
        $this->refreshTokenExpiresAt = (int) $refreshTokenExpireAt;
        $this->scope = $scope;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getAccessToken();
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @return int
     */
    public function getRefreshTokenExpiresAt()
    {
        return $this->refreshTokenExpiresAt;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }
}