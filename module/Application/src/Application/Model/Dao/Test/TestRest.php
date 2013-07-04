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
     * @param string $date
     * @return array
     */
    public function findAllByMonitorAndDate(array $monitors, $date)
    {
        //$response = '{"Version":"current","Request":{"Return":"[Account[Pages[Page[Id,Url,Label,CurrentStatus,DownloadSpeed,Alerting]]]]","AccountId":"MN2A7711","Format":"json"},"Response":{"Status":"Ok","Code":200,"Message":"Success.","Account":{"Pages":{"Page":[{"Id":"MN2PG43094","Url":"http:\/\/selfridges.cloudopsguys.com\/","Label":"Selfridges via aiCache only","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43095","Url":"http:\/\/www.selfridges.com\/","Label":"Selfridges Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43509","Url":"https:\/\/airbnb-uk.cloudopsguys.com\/","Label":"AirBnB UK aiCache","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43508","Url":"https:\/\/www.airbnb.co.uk\/","Label":"AirBnB UK Direct","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43098","Url":"http:\/\/selfridges.cloudopsguys.com:81\/","Label":"Selfridges via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43099","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/","Label":"Selfridges via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43100","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43101","Url":"http:\/\/selfridges.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43102","Url":"http:\/\/selfridges.cloudopsguys.com:81\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43103","Url":"http:\/\/www.selfridges.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"}]}}}}';

        $response = file_get_contents(
            'https://api.siteconfidence.co.uk/current/' . $this->getIdentity()->getId(
            ) . '/Return/[Account[Pages[Page[TestResults[Count,Limit,Offset,TestResult[TotalSeconds]]]]]]/AccountId/' . $this->getIdentity()->getAccountId() . '/Id/' . implode(',', $monitors) . '/StartDate/2013-06-30/EndDate/2013-07-01/LimitTestResults/200//Format/json'
        );

        $reader = new Json();
        $result = $reader->fromString($response);

        return $result;
    }


}