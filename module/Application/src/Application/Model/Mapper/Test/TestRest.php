<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Entity\Test\Test as TestEntity;
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
            ->setTotalSeconds($data['TotalSeconds']);

        return $testEntity;
    }

    /**
     * @param AccountEntity $accountEntity
     * @param MonitorEntity $monitorEntity
     * @return array
     */
    public function findAllByMonitorAndDate(AccountEntity $accountEntity, MonitorEntity $monitorEntity)
    {
        $response = $this->getDao()->findAllByAccounts();
        var_dump($response);
        exit;

        //$tests[] = self::mapToInternal($response['Response']['Account']);

        return $tests;
    }


}