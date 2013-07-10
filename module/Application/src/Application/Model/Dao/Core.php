<?php
namespace Application\Model\Dao;

use Application\Model\Entity\User;
use Zend\Authentication\AuthenticationService;
use Zend\Config\Reader\Json;

/**
 * Class Monitor
 *
 * @package Application\Model\Dao\Monitor
 */
class Core
{

    /**
     * @var \Application\Model\Entity\User
     */
    protected $identity;


    public function __construct(AuthenticationService $authService)
    {
        $this->setIdentity($authService->getIdentity());
    }

    /**
     * @param \Application\Model\Entity\User $identity
     * @return $this
     */
    public function setIdentity(User $identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * @return \Application\Model\Entity\User
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @todo caching event
     * @todo logging request/response event (audit)
     *
     * @param string $request
     * @return array
     */
    public function getClient($request)
    {
        $response = @file_get_contents(
            'https://api.siteconfidence.co.uk/current/' . $this->getIdentity()->getId() .
            $request .
            '/Format/json');

        $reader = new Json();
        $result = $reader->fromString($response);

        return $result;
    }

}