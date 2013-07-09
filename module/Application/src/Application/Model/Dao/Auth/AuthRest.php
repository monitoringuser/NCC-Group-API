<?php
namespace Application\Model\Dao\Auth;

use Common\Model\Dao\DaoInterface;
use Zend\Http\Client;
use Zend\Http\Request;

/**
 * Class Auth
 *
 * @package Application\Model\Dao\Auth
 */
class AuthRest implements AuthInterface, DaoInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data)
    {
        //$response = '{"Version":"current","Request":"Request","Response":{"Status":"Ok","Code":200,"Message":"Success.","ApiKey":{"Lifetime":3600,"Value":"84d14aabee74231d06b4adfe7b211979"}}}';

        // @TODO: Replace with Http\Client
        $response = @file_get_contents(
            'https://api.siteconfidence.co.uk/current/username/' . $data['email'] . '/password/' . $data['password'] . '/Format/json'
        );
        if (!$response) {
            $response = array(
                'Response' => array(
                    'ApiKey' => array(
                        'Value' => null
                    ),
                    'Status' => 'Failed',
                    'Code'   => 401
                )
            );
            $response = json_encode($response);
        }

        // Zend\Json\Json::decode()
        $reader = new \Zend\Config\Reader\Json();
        $result = $reader->fromString($response);

        $result['email'] = $data['email'];

        return $result;
    }

}