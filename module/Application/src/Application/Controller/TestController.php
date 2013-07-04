<?php
namespace Application\Controller;

use Application\Model\Entity\Account as AccountEntity;
use Application\Model\Entity\Monitor as MonitorEntity;
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
        $accountId = (string)$this->params()->fromRoute('id', null);
        $monitorId = (string)$this->params()->fromRoute('name', null);


        $accountEntity = new AccountEntity();
        $monitorEntity = new MonitorEntity();

        $testService = $this->getServiceLocator()->get('Application\Model\Service\Test');
        $tests       = $testService->findAllByMonitorAndDate(
            $accountEntity->setId($accountId),
            $monitorEntity->setId($monitorId)
        );

        return array(
            'tests' => $tests
        );
    }


}
