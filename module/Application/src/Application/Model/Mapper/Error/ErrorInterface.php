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
     * @return AccountCollection
     */
    public function findAll();

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorId(MonitorEntity $monitorEntity);

}