<?php
namespace Application\Model\Mapper\Error;

use Application\Model\Entity\Account\AccountCollection as AccountCollection;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;

/**
 * Class ErrorInterface
 *
 * @package Application\Model\Mapper\Error
 */
interface ErrorInterface
{

    /**
     * @param AccountCollection $accountCollection
     * @return AccountCollection
     */
    public function findAllByAccounts(AccountCollection $accountCollection);

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorId(MonitorEntity $monitorEntity);

}