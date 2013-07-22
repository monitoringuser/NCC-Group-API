<?php
namespace ApplicationTest\Model\Mocks\Test;

use Application\Model\Dao\Error\ErrorInterface;
use Common\Model\Dao\DaoInterface;

/**
 * Class Result
 *
 * @package ApplicationTest\Model\Mocks\Test
 */
class Result implements ErrorInterface, DaoInterface
{

    /**
     * @var string
     */
    protected $findAllByMonitorId = '{"Version":"current","Request":{"Return":"[Account[Pages[Page[Id,Url,Label,CurrentStatus,Errors[Open[Count,Error[Id,Ref,StatusCode,Status,Notes,ResultCode,Result,Duration]],Closed[Count,Error[Id,Ref,StatusCode,Status,ResultCode,Result,Duration]]]]]]]","AccountId":"MN2A7711","Id":"MN2PG43095","Format":"json"},"Response":{"Status":"Ok","Code":200,"Message":"Success.","Account":{"Pages":{"Page":{"Id":"MN2PG43095","Url":"http:\/\/www.selfridges.com\/","Label":"Selfridges Direct","CurrentStatus":"Warning","Errors":{"Open":{"Count":"1","Error":{"Id":"MN2PG43095E8721172","Ref":"8721172","StatusCode":"2","Status":"Warning","Notes":"","ResultCode":null,"Result":"Missing Object","Duration":147956}},"Closed":{"Count":"11","Error":[{"Id":"MN2PG43095E8721165","Ref":"8721165","StatusCode":"2","Status":"Warning","ResultCode":"28","Result":"Web Server Connection Failed For Object","Duration":277},{"Id":"MN2PG43095E8720714","Ref":"8720714","StatusCode":"2","Status":"Warning","ResultCode":"3","Result":"Missing Object","Duration":16202},{"Id":"MN2PG43095E8720709","Ref":"8720709","StatusCode":"2","Status":"Warning","ResultCode":"48","Result":"Could Not Write Request For Object","Duration":293},{"Id":"MN2PG43095E8720089","Ref":"8720089","StatusCode":"2","Status":"Warning","ResultCode":"3","Result":"Missing Object","Duration":34825},{"Id":"MN2PG43095E8720083","Ref":"8720083","StatusCode":"2","Status":"Warning","ResultCode":"28","Result":"Web Server Connection Failed For Object","Duration":277},{"Id":"MN2PG43095E8718705","Ref":"8718705","StatusCode":"2","Status":"Warning","ResultCode":"3","Result":"Missing Object","Duration":55522},{"Id":"MN2PG43095E8718696","Ref":"8718696","StatusCode":"2","Status":"Warning","ResultCode":"11","Result":"Object Download Timed Out","Duration":278},{"Id":"MN2PG43095E8716860","Ref":"8716860","StatusCode":"2","Status":"Warning","ResultCode":"3","Result":"Missing Object","Duration":87023},{"Id":"MN2PG43095E8716817","Ref":"8716817","StatusCode":"2","Status":"Warning","ResultCode":"28","Result":"Web Server Connection Failed For Object","Duration":279},{"Id":"MN2PG43095E8712184","Ref":"8712184","StatusCode":"2","Status":"Warning","ResultCode":"3","Result":"Missing Object","Duration":265219},{"Id":"MN2PG43095E8712174","Ref":"8712174","StatusCode":"2","Status":"Warning","ResultCode":"13","Result":"Object Server Error","Duration":283}]}}}}}}}';

    /**
     * @var string
     */
    protected $findAllByAccounts = '';

    /**
     * @param string $accounts
     * @return array
     */
    public function findAllByAccounts($accounts)
    {
        return $this->findAllByAccounts;
    }

    /**
     * @param string $monitorId
     * @return array
     */
    public function findAllByMonitorId($monitorId)
    {
        return $this->findAllByMonitorId;
    }


}