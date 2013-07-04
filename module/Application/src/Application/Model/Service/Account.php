<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;

/**
 * Class Account
 *
 * @package Application\Model\Service
 */
class Account extends Core
{

    /**
     * @return array
     */
    public function findAll()
    {
        $accounts = $this->getMapper()->findAll();

        // save accounts to identity
        foreach($accounts as $account) {
            $authService = $this->getServiceLocator()->get('AuthenticationService');
            $authService->getIdentity()->addAccount($account);
        }

        return $accounts;
    }

}