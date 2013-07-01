<?php
namespace Application\Model\Mapper\Auth;

use Application\Model\Entity\User as UserEntity;
use Common\Model\Mapper\Core;

/**
 * Class AuthWebService
 *
 * @package Application\Model\Mapper\Auth
 */
class AuthRest extends Core implements AuthInterface
{

    /**
     * @param UserEntity $userEntity
     * @return array
     */
    static public function mapToExternal(UserEntity $userEntity)
    {
        $data = array(
            'id'         => $userEntity->getId(),
            'email'      => $userEntity->getEmail(),
            'password'   => $userEntity->getPassword(),
            'status'     => $userEntity->getStatus(),
            'code'       => $userEntity->getCode(),
            'created_on' => $userEntity->getCreatedOn(),
        );

        return $data;
    }

    /**
     * @param array $data
     * @return UserEntity $userEntity
     */
    static public function mapToInternal(array $data)
    {
        $userEntity = new UserEntity;
        $userEntity->setId($data['Response']['ApiKey']['Value'])
            ->setEmail($data['email'])
            //->setPassword($data['Response']['password'])
            ->setStatus($data['Response']['Status'])
            ->setCode($data['Response']['Code']);
            //->setCreatedOn($data['Response']['created_on']);

        return $userEntity;
    }

    /**
     * @param UserEntity $userEntity
     * @return UserEntity
     */
    public function login(UserEntity $userEntity)
    {
        $data = self::mapToExternal($userEntity);

        $response = $this->getDao()->login($data);

        $userEntity = self::mapToInternal($response);

        return $userEntity;
    }


}