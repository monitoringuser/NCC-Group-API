<?php
namespace Application\Model\Service;

use Application\Model\Entity\Monitor\MonitorCollection;
use Application\Model\Entity\Test\TestCollection;
use Common\Model\Service\Core;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;

/**
 * Class Monitor
 *
 * @package Application\Model\Service
 */
class Test extends Core
{

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorAndDate(MonitorEntity $monitorEntity)
    {
        $monitorEntity  = $this->getMapper()->findAllByMonitorAndDate($monitorEntity);

        return $monitorEntity;
    }

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findLast24hrs(MonitorEntity $monitorEntity)
    {
        // last 24hrs
        $date = new \DateTime();
        $date->sub(new \DateInterval('P1D'));
        $startDate = $date->format('Y-m-d H:i:s');

        $date = new \DateTime();
        $endDate = $date->format('Y-m-d H:i:s');

        $testCollectionCurrent = new TestCollection();
        $testCollectionCurrent->setStartDate($startDate)
            ->setEndDate($endDate);

        $monitorCurrent  = $this->findAllByMonitorAndDate(
            $monitorEntity->addTestCollection($testCollectionCurrent)
                    ->setActiveTestCollection($testCollectionCurrent)
        );

        return $monitorEntity;
    }

}