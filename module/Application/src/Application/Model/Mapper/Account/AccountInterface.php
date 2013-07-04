<?php
namespace Application\Model\Mapper\Account;

use Application\Model\Entity\Account as AccountEntity;

interface AccountInterface
{

    /**
     * @return array
     */
    public function findAll();

}