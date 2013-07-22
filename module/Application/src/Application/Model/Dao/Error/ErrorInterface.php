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
     * @param string $accounts
     * @return array
     */
    public function findAllByAccounts($accounts);

    /**
     * @param string $monitorId
     * @return array
     */
    public function findAllByMonitorId($monitorId);

}