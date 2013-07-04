<?php
namespace Application\Model\Dao\Monitor;

/**
 * Class MonitorInterface
 *
 * @package Application\Model\Dao\Monitor
 */
interface MonitorInterface
{

    /**
     * @param string $accounts
     * @return array
     */
    public function findAllByAccounts($accounts);

}