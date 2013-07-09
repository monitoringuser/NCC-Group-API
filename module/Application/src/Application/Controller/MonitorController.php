<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Entity\Account\Account as AccountEntity;

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
    public function accountAction()
    {
        $accountId = (string) $this->params()->fromRoute('accountId', null);

        $accountEntity = new AccountEntity();
        $accountEntity->setId($accountId);

        $monitorService = $this->getServiceLocator()->get('Application\Model\Service\Monitor');
        $monitors = $monitorService->findAllByAccount($accountEntity);

        // use indexAction view template (or move to partial)
        $view = new ViewModel(
            array(
                'monitors' => $monitors
            )
        );
        $view->setTemplate('application/monitor/index.phtml');
        return $view;
    }


}
