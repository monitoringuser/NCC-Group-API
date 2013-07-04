<?php
namespace Application\Model\Dao\Account;

use Application\Model\Dao\Core;
use Common\Model\Dao\DaoInterface;

/**
 * Class Account
 *
 * @package Application\Model\Dao\Account
 */
class AccountRest extends Core implements AccountInterface, DaoInterface
{

    /**
     * @return array
     */
    public function findAll()
    {
        //$response = '{"Version":"current","Request":{"Format":"json"},"Response":{"Status":"Ok","Code":200,"Message":"Success.","Account":{"AccountId":"MN2A7711","Name":"Seriti Consulting","Tz":"0","Country":null,"TimeOffset":3600,"ServiceStatus":{"HighestStatusCode":"1","ServiceType":"monitoring"}}}}';

        $response = $this->getClient('');

        return $response;
    }


}