<?php
namespace Application\Model\Dao\Error;

use Application\Model\Dao\Core;
use Common\Model\Dao\DaoInterface;
use Zend\Config\Reader\Json;

/**
 * Class Error
 *
 * @package Application\Model\Dao\Error
 */
class ErrorRest extends Core implements ErrorInterface, DaoInterface
{

    /**
     * @return array
     */
    public function findAll()
    {
        $response = $this->getClient(
            '/Return/[Account[AccountId,Name,Pages[Page[Id,Url,Label,Notes,CurrentStatus,Errors[Open[Error[Id,Ref,LocalDateTime,StatusCode,Status,Notes,ResultCode,Result,Classification,Duration]],Closed[Count,Error[Id,Ref,LocalDateTime,StatusCode,Status,Notes,ResultCode,Result,Classification,Duration]]]]]]]/AccountId/' .
            implode(',', $this->getIdentity()->getAccounts()->getIdsAsArray())
        );

        return $response;
    }

    /**
     * @param string $monitorId
     * @return array
     */
    public function findAllByMonitorId($monitorId)
    {
        $response = $this->getClient(
            '/Return/[Account[AccountId,Name,Pages[Page[Id,Url,Label,Notes,CurrentStatus,Errors[Open[Error[Id,Ref,LocalDateTime,StatusCode,Status,Notes,ResultCode,Result,Classification,Duration]],Closed[Count,Error[Id,Ref,LocalDateTime,StatusCode,Status,Notes,ResultCode,Result,Classification,Duration]]]]]]]/AccountId/' .
            implode(',', $this->getIdentity()->getAccounts()->getIdsAsArray()) .
            '/Id/' . (string) $monitorId
        );

        return $response;
    }


}