<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;
use Application\Model\Entity\Account\AccountCollection;

/**
 * Class Account
 *
 * @package Application\Model\Service
 */
class Account extends Core
{

    /**
     * @return AccountCollection
     */
    public function findAll()
    {
        $accountCollection = $this->getMapper()->findAll();

        // save accounts to identity
        $authService = $this->getServiceLocator()->get('AuthenticationService');
        $authService->getIdentity()->setAccounts($accountCollection);

        return $accountCollection;
    }

}