<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Monitor as MonitorEntity;

interface MonitorInterface
{

    /**
     * @param array $accounts
     * @return array
     */
    public function findAllByAccounts(array $accounts);

}