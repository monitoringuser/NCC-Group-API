<?php
namespace Application\Model\Service;

use Application\Model\Entity\Monitor as MonitorEntity;
use Common\Model\Service\Core;

/**
 * Class Monitor
 *
 * @package Application\Model\Service
 */
class Monitor extends Core
{

    /**
     * @return array
     */
    public function findAll()
    {
        $monitors = $this->getMapper()->findAll();

        return $monitors;
    }

}