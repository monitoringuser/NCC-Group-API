<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;
use Application\Model\Entity\Monitor\MonitorCollection;

/**
 * Class Monitor
 *
 * @package Application\Model\Service
 */
class Test extends Core
{

    /**
     * @param MonitorCollection $monitorCollection
     * @return array
     */
    public function findAllByMonitorsAndDate(MonitorCollection $monitorCollection)
    {
        $monitors = $this->getMapper()->findAllByMonitorsAndDate($monitorCollection);

        return $monitors;
    }

}