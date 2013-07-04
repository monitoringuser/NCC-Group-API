<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class MonitorController
 *
 * @package Application\Controller
 */
class AccountController extends AbstractActionController
{

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $accountService = $this->getServiceLocator()->get('Application\Model\Service\Account');
        $accounts = $accountService->findAll();

        return array(
            'accounts' => $accounts
        );
    }


}
