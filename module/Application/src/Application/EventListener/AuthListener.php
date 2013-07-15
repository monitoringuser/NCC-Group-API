<?php
namespace Application\EventListener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class AuthListener
 *
 * @package Application\EventListener
 */
class AuthListener implements EventManagerAwareInterface
{

    /**
     * @var array
     */
    protected $whiteList = array('auth_login', 'home');

    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * @var
     */
    protected $event;

    public function __construct(MvcEvent $event)
    {
        $this->setEvent($event);
    }

    /**
     * @param EventManagerInterface $events
     * @return $this|void
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
                __CLASS__,
                get_called_class(),
            ));
        $this->events = $events;
        return $this;
    }

    /**
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    /**
     * Check if user has identity to access secure page, otherwise redirect to login page
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function hasIdentity()
    {
        $auth = $this->getEvent()->getApplication()->getServiceManager()->get('AuthenticationService');

        // Route is whitelisted
        $route = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        if (in_array($route, $this->whiteList)) {
            return;
        }

        // User is authenticated
        if ($auth->hasIdentity()) {
            return;
        }

        // Redirect to the user login page, as an example
        $router   = $this->getEvent()->getRouter();
        $url      = $router->assemble(array(), array(
                'name' => 'auth_login'
            ));

        $response = $this->getEvent()->getResponse();
        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode(302);

        return $response;
    }

    /**
     * @return MvcEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param MvcEvent $event
     * @return AuthListener
     */
    public function setEvent(MvcEvent $event)
    {
        $this->event = $event;

        return $this;
    }


}