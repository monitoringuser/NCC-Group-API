<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Account as AccountEntity;
use Application\Model\Entity\Monitor as MonitorEntity;

interface TestInterface
{

    /**
     * @param AccountEntity $accountEntity
     * @param MonitorEntity $monitorEntity
     * @return array
     */
    public function findAllByMonitorAndDate(AccountEntity $accountEntity, MonitorEntity $monitorEntity);

}