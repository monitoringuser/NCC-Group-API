<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Monitor\Monitor as MonitorEntity;

interface TestInterface
{

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorAndDate(MonitorEntity $monitorEntity);

}