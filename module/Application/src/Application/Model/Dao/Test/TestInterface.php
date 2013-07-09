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
     * @param array $monitors
     * @param string      $startDate
     * @param string      $endDate
     * @return array
     */
    public function findAllByMonitorsAndDate(array $monitors, $startDate, $endDate);

}