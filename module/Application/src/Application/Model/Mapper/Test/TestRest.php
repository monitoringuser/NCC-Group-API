<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Entity\Monitor\MonitorCollection;
use Application\Model\Entity\Test\Test as TestEntity;
use Application\Model\Entity\Test\TestCollection;
use Common\Model\Mapper\Core;

/**
 * Class TestRest
 *
 * @package Application\Model\Mapper\Auth
 */
class TestRest extends Core implements TestInterface
{

    /**
     * @param TestEntity $testEntity
     * @return array
     */
    static public function mapToExternal(TestEntity $testEntity)
    {
        $data = array(
            'id'           => $testEntity->getId(),
            'totalSeconds' => $testEntity->getTotalSeconds(),
            'datetime' => $testEntity->getDatetime()
        );

        return $data;
    }

    /**
     * @param array $data
     * @return TestEntity $testEntity
     */
    static public function mapToInternal(array $data)
    {
        $testEntity = new TestEntity;
        $testEntity->setId($data['Id'])
            ->setDatetime($data['GmtDateTime'])
            ->setTotalSeconds($data['TotalSeconds']);

        return $testEntity;
    }

    /**
     * @param MonitorCollection $monitorCollection
     * @return MonitorCollection
     */
    public function findAllByMonitorsAndDate(MonitorCollection $monitorCollection)
    {
        $response = $this->getDao()->findAllByMonitorsAndDate(
            $monitorCollection->getIdsAsArray(),
            $monitorCollection->getStartDate(),
            $monitorCollection->getEndDate()
        );

        $testResults = $response['Response']['Account']['Pages']['Page']['TestResults'];
        $testCollection = new TestCollection();
        $testCollection->setCount($testResults['Count'])
            ->setLimit($testResults['Limit'])
            ->setOffset($testResults['Offset']);

        foreach ($response['Response']['Account']['Pages']['Page']['TestResults']['TestResult'] as $test) {
            $testCollection->addTest(self::mapToInternal($test));
        }

        $monitor = $response['Response']['Account']['Pages']['Page'];
        $monitorEntity = new MonitorEntity();
        $monitorEntity->setId($monitor['Id'])
            ->setUrl($monitor['Url'])
            ->setLabel($monitor['Label'])
            ->setTests($testCollection);

        return $monitorCollection->addMonitor($monitorEntity);
    }


}