<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;

/**
 * Class ErrorController
 *
 * @package Application\Controller
 */
class ErrorController extends AbstractActionController
{

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $errorService = $this->getServiceLocator()->get('Application\Model\Service\Error');
        $errors = $errorService->findAll();

        return array(
            'errors' => $errors
        );
    }

    /**
     * @return array|ViewModel
     */
    public function monitorAction()
    {
        $monitorId = (string) $this->params()->fromRoute('monitorId', null);

        $monitorEntity = new MonitorEntity();
        $monitorEntity->setId($monitorId);

        $errorService = $this->getServiceLocator()->get('Application\Model\Service\Error');
        $errors = $errorService->findAllByAccount($monitorEntity);

        // use indexAction view template (or move to partial)
        $view = new ViewModel(
            array(
                'errors' => $errors
            )
        );
        $view->setTemplate('application/error/index.phtml');
        return $view;
    }


}
