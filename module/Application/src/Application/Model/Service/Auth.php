<?php
namespace Application\Model\Service;

use Application\Model\Entity\User as UserEntity;
use Application\Model\Service\Exception\AuthenticationError as AuthException;
use Common\Model\Service\Core;
use Zend\Authentication\Adapter\AdapterInterface as AuthenticationInterface;
use Zend\Authentication\Result as AuthResult;

/**
 * Class Auth
 *
 * @package Application\Model\Service
 */
class Auth extends Core implements AuthenticationInterface
{
    /**
     * @var UserEntity
     */
    protected $userEntity;

    /**
     * @return \Application\Model\Entity\User
     */
    public function getUserEntity()
    {
        return $this->userEntity;
    }

    /**
     * @param \Application\Model\Entity\User $userEntity
     * @return UserEntity
     */
    public function setUserEntity(UserEntity $userEntity)
    {
        $this->userEntity = $userEntity;

        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $userEntity = $this->getMapper()->login($this->getUserEntity());

        switch ($userEntity->getCode()) {
            case 200:
                $code = AuthResult::SUCCESS;
                break;
            case 401:
                $code = AuthResult::FAILURE;
                break;
            default:
                throw new AuthException('Authentication failed');
        }

        $authResult = new AuthResult($code, $userEntity);

        return $authResult;
    }


}