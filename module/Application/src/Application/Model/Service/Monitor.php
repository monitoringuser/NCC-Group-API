<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;
use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Account\AccountCollection as AccountCollection;

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
     * @return AccountEntity
     */
    public function findAllByAccount(AccountEntity $account)
    {
        $accountCollectionRequest = new AccountCollection;
        $accountCollectionRequest->addAccount($account);

        $accountCollectionRequest = $this->findAllByAccounts($accountCollectionRequest);
        $accountResponse = $accountCollectionRequest->getAccount($account);

        return $accountResponse;
    }

    /**
     * @param AccountCollection $accountCollection
     * @return AccountCollection
     */
    public function findAllByAccounts(AccountCollection $accountCollection)
    {
        $accountCollectionResponse = $this->getMapper()->findAllByAccounts($accountCollection);

        return $accountCollectionResponse;
    }

}