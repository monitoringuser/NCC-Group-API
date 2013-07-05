<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Account\AccountCollection as AccountCollection;

/**
 * Class MonitorInterface
 *
 * @package Application\Model\Mapper\Monitor
 */
interface MonitorInterface
{

    /**
     * @param AccountCollection $accountCollection
     * @return AccountCollection
     */
    public function findAllByAccounts(AccountCollection $accountCollection);

}