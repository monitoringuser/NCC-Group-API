<?php
namespace Application\Controller;

use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Entity\Monitor\MonitorCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class TestController
 *
 * @package Application\Controller
 */
class TestController extends AbstractActionController
{

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $monitorId = (string)$this->params()->fromRoute('monitorId', null);

        $monitorEntity = new MonitorEntity();
        $monitorEntity->setId($monitorId);

        $testService = $this->getServiceLocator()->get('Application\Model\Service\Test');
        $monitorEntity = $testService->findLast24hrs($monitorEntity);

        return array(
            'monitor' => $monitorEntity
        );
    }


}
