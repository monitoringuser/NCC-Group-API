<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Monitor as MonitorEntity;

interface MonitorInterface
{

    /**
     * @return array
     */
    public function findAll();

}