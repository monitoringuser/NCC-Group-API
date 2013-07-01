<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\Dao\Auth\AuthRest as AuthDao;
use Application\Model\Mapper\Auth\AuthRest as AuthMapper;
use Application\Model\Service\Auth as AuthService;
use Application\Model\Dao\Monitor\MonitorRest as MonitorDao;
use Application\Model\Mapper\Monitor\MonitorRest as MonitorMapper;
use Application\Model\Service\Monitor as MonitorService;
use Zend\Authentication\AuthenticationService;
use Application\View\Helper\Identity as IdentityViewHelper;

/**
 * Class Module
 *
 * @package Application
 */
class Module
{

    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'AuthenticationService' => 'Zend\Authentication\AuthenticationService'
            ),
            'factories' => array(
                // auth
                'Application\Model\Service\Auth' => function($sm) {
                    $mapper = $sm->get('Application\Model\Mapper\Auth\AuthRest');
                    $service = new AuthService($mapper);
                    return $service;
                },
                'Application\Model\Mapper\Auth\AuthRest' => function($sm) {
                    $dao = $sm->get('Application\Model\Dao\Auth\AuthRest');
                    $mapper = new AuthMapper($dao);
                    return $mapper;
                },
                'Application\Model\Dao\Auth\AuthRest' =>  function($sm) {
                    $dao = new AuthDao;
                    return $dao;
                },
                // monitors
                'Application\Model\Service\Monitor' => function($sm) {
                    $mapper = $sm->get('Application\Model\Mapper\Monitor\MonitorRest');
                    $service = new MonitorService($mapper);
                    return $service;
                },
                'Application\Model\Mapper\Monitor\MonitorRest' => function($sm) {
                    $dao = $sm->get('Application\Model\Dao\Monitor\MonitorRest');
                    $mapper = new MonitorMapper($dao);
                    return $mapper;
                },
                'Application\Model\Dao\Monitor\MonitorRest' =>  function($sm) {
                    $dao = new MonitorDao;
                    return $dao;
                },

            ),

        );
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'getAuthenticationService' => function($sm) {
                    $authenticationService = $sm->getServiceLocator()->get('AuthenticationService');
                    $helper = new IdentityViewHelper($authenticationService);
                    return $helper;
                },

            )
        );
    }

}
