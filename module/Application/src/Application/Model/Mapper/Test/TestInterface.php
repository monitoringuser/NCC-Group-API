<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Monitor\MonitorCollection;

interface TestInterface
{

    /**
     * @param MonitorCollection $monitorCollection
     * @return MonitorCollection
     */
    public function findAllByMonitorsAndDate(MonitorCollection $monitorCollection);

}