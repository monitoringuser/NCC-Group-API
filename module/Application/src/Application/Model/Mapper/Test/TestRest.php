<?php
namespace Application\Model\Mapper\Test;

use Application\Model\Entity\Account as AccountEntity;
use Application\Model\Entity\Monitor as MonitorEntity;
use Application\Model\Entity\Test as TestEntity;
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
            'id'       => $testEntity->getId(),
        );

        return $data;
    }

    /**
     * @param array  $data
     * @return TestEntity $testEntity
     */
    static public function mapToInternal(array $data)
    {
        $accountEntity = new TestEntity;
        $accountEntity->setId($data['AccountId']);

        return $accountEntity;
    }

    /**
     * @param AccountEntity $accountEntity
     * @param MonitorEntity $monitorEntity
     * @return array
     */
    public function findAllByMonitorAndDate(AccountEntity $accountEntity, MonitorEntity $monitorEntity)
    {
        $response = $this->getDao()->findAllByAccounts();
var_dump($response); exit;
        //$tests[] = self::mapToInternal($response['Response']['Account']);

        return $tests;
    }


}