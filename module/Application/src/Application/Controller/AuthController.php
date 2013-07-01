<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\LoginForm;
use Application\Model\Entity\User as UserEntity;

/**
 * Class AuthController
 *
 * @package Application\Controller
 */
class AuthController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function loginAction()
    {
        $form = new LoginForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $userEntity = new UserEntity();
            $form->setInputFilter($userEntity->getInputFilter())
                ->setData($request->getPost());

            if ($form->isValid()) {
                $userEntity->exchangeArray($form->getData());
                $authAdapter = $this->getServiceLocator()
                    ->get('Application\Model\Service\Auth')
                    ->setUserEntity($userEntity);

                $authService = $this->getServiceLocator()->get('AuthenticationService');
                $authResult = $authService->authenticate($authAdapter);

                if ($authResult->isValid()) {
                    $this->flashMessenger()->addSuccessMessage(
                        'Login Successful'
                    );
                    return $this->redirect()->toRoute('monitor');
                } else {
                    $this->flashMessenger()->addErrorMessage(
                        'Login Failed'
                    );
                    return $this->redirect()->toRoute(null, array('action' => 'login'));
                }
            }
        }

        return array(
            'form'      => $form,
        );
    }

    /**
     * @return ViewModel
     */
    public function logoutAction()
    {
        $this->getServiceLocator()->get('AuthenticationService')->clearIdentity();
        return $this->redirect()->toRoute(null, array('action' => 'login'));
    }

}
