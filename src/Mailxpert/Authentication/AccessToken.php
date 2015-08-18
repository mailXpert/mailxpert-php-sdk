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
     * @var string
     */
    private $expiresAt;

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
     */
    public function __construct($accessToken, $refreshToken, $expiresAt, $scope = null)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresAt = $expiresAt;
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
     * @return string
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }
}