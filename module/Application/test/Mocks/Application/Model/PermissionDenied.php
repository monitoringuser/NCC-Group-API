<?php
namespace Test\Mocks\Application\Model;

use Common\Model\Dao\DaoInterface;

/**
 * Class Result
 *
 * @package ApplicationTest\Model\Mocks\Test
 */
class PermissionDenied implements DaoInterface
{

    /**
     * @var string
     */
    protected $response = '{"Version":"current","Request":"Request","Response":{"Status":"Fail","Code":401,"Message":"Authentication failure."}}';

    /**
     * @return array
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * Any request using this mock will return a 401 Authentication Failed
     *
     * @return array
     */
    public function __call()
    {
        return $this->response();
    }


}