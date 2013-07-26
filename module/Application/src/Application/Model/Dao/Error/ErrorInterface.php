<?php
namespace Application\Model\Dao\Error;

/**
 * Class ErrorInterface
 *
 * @package Application\Model\Dao\Error
 */
interface ErrorInterface
{

    /**
     * @return array
     */
    public function findAll();

    /**
     * @param string $monitorId
     * @return array
     */
    public function findAllByMonitorId($monitorId);

}