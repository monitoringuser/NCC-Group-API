<?php
namespace Application\Model\Service;

use Common\Model\Service\Core;

/**
 * Class Error
 *
 * @package Application\Model\Service
 */
class Error extends Core
{

    /**
     * @return array
     */
    public function findAll()
    {
        $monitors = $this->getMapper()->findAll();

        return $monitors;
    }

    /**
     * @param string $monitorID
     * @return array
     */
    public function findAllByMonitorId($monitorID)
    {
        $monitors = $this->getMapper()->findAllByMonitorId($monitorID);

        return $monitors;
    }

}