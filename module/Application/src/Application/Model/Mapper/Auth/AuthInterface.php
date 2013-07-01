<?php
namespace Application\Model\Mapper\Auth;

use Application\Model\Entity\User as UserEntity;

interface AuthInterface
{

    /**
     * @param UserEntity $user
     * @return UserEntity
     */
    public function login(UserEntity $user);

}