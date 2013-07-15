<?php
namespace Application\Model\Dao\Test;

/**
 * Class TestInterface
 *
 * @package Application\Model\Dao\Test
 */
interface TestInterface
{

    /**
     * @param string      $monitorId
     * @param string      $startDate
     * @param string      $endDate
     * @return array
     */
    public function findAllByMonitorAndDate($monitorId, $startDate, $endDate);

}