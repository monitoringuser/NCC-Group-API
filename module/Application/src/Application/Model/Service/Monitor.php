<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;
use Application\Model\Entity\Account as AccountEntity;

/**
 * Class Monitor
 *
 * @package Application\Model\Service
 */
class Monitor extends Core
{

    /**
     * @return array
     */
    public function findAll()
    {
        $authService = $this->getServiceLocator()->get('AuthenticationService');

        $monitors = $this->getMapper()->findAllByAccounts($authService->getIdentity()->getAccounts());

        return $monitors;
    }

    /**
     * @param AccountEntity $account
     * @return array
     */
    public function findAllByAccount(AccountEntity $account)
    {
        $monitors = $this->getMapper()->findAllByAccounts(array($account));

        return $monitors;
    }

}