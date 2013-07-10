<?php
namespace Application\Model\Dao\Test;

use Application\Model\Dao\Core;
use Common\Model\Dao\DaoInterface;
use Zend\Config\Reader\Json;

/**
 * Class Monitor
 *
 * @package Application\Model\Dao\Monitor
 */
class TestRest extends Core implements TestInterface, DaoInterface
{

    /**
     * @param array  $monitors
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function findAllByMonitorsAndDate(array $monitors, $startDateTime, $endDateTime)
    {
        //$response = '{"Version":"current","Request":{"Return":"[Account[Pages[Page[Id,Url,Label,CurrentStatus,DownloadSpeed,Alerting]]]]","AccountId":"MN2A7711","Format":"json"},"Response":{"Status":"Ok","Code":200,"Message":"Success.","Account":{"Pages":{"Page":[{"Id":"MN2PG43094","Url":"http:\/\/selfridges.cloudopsguys.com\/","Label":"Selfridges via aiCache only","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43095","Url":"http:\/\/www.selfridges.com\/","Label":"Selfridges Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43509","Url":"https:\/\/airbnb-uk.cloudopsguys.com\/","Label":"AirBnB UK aiCache","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43508","Url":"https:\/\/www.airbnb.co.uk\/","Label":"AirBnB UK Direct","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43098","Url":"http:\/\/selfridges.cloudopsguys.com:81\/","Label":"Selfridges via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43099","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/","Label":"Selfridges via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43100","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43101","Url":"http:\/\/selfridges.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43102","Url":"http:\/\/selfridges.cloudopsguys.com:81\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43103","Url":"http:\/\/www.selfridges.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"}]}}}}';

        $startDateTime = explode(' ', $startDateTime);
        $endDateTime = explode(' ', $endDateTime);

        $response = $this->getClient(
            '/Return/[Account[Pages[Page[Id,Url,Label,TestResults[Count,Limit,Offset,TestResult[Id,ResultId,GmtDateTime,TotalSeconds]]]]]]/AccountId/' .
            implode(',', $this->getIdentity()->getAccounts()->getIdsAsArray()) . '/Id/' .
            implode(',', $monitors) .
            '/StartDate/' . $startDateTime[0] .
            '/StartTime/' . $startDateTime[1] .
            '/EndDate/' . $endDateTime[0] .
            '/EndTime/' . $endDateTime[1] .
            '/LimitTestResults/1000/Format/json'
        );

        return $response;
    }


}