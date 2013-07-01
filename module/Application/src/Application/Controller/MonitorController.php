<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class MonitorController
 *
 * @package Application\Controller
 */
class MonitorController extends AbstractActionController
{

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $monitorService = $this->getServiceLocator()->get('Application\Model\Service\Monitor');
        $monitors = $monitorService->findAll();

        return array(
            'monitors' => $monitors
        );
    }

    /**
     * @return array|ViewModel
     */
    public function trendAction()
    {
        return new ViewModel();
    }

}
