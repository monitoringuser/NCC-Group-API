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
     * @param string      $date
     * @return array
     */
    public function findAllByMonitorAndDate(array $monitors, $date);

}