<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;
use Application\Model\Entity\Account as AccountEntity;
use Application\Model\Entity\Monitor as MonitorEntity;

/**
 * Class Monitor
 *
 * @package Application\Model\Service
 */
class Test extends Core
{

    /**
     * @param AccountEntity $accountEntity
     * @param MonitorEntity $monitorEntity
     * @return array
     */
    public function findAllByMonitorAndDate(AccountEntity $accountEntity, MonitorEntity $monitorEntity)
    {
        $monitors = $this->getMapper()->findAllByMonitorAndDate($accountEntity, $monitorEntity);

        return $monitors;
    }

}