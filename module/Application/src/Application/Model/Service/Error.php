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
        $authService = $this->getServiceLocator()->get('AuthenticationService');

        $monitors = $this->getMapper()->findAll();

        return $monitors;
    }



}