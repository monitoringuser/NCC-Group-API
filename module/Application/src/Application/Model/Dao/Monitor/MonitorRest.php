<?php
namespace Application\Model\Dao\Monitor;

use Application\Model\Dao\Core;
use Common\Model\Dao\DaoInterface;
use Zend\Config\Reader\Json;

/**
 * Class Monitor
 *
 * @package Application\Model\Dao\Monitor
 */
class MonitorRest extends Core implements MonitorInterface, DaoInterface
{

    /**
     * @param string $accounts
     * @return array
     */
    public function findAllByAccounts($accounts)
    {
        //$response = '{"Version":"current","Request":{"Return":"[Account[Pages[Page[Id,Url,Label,CurrentStatus,DownloadSpeed,Alerting]]]]","AccountId":"MN2A7711","Format":"json"},"Response":{"Status":"Ok","Code":200,"Message":"Success.","Account":{"Pages":{"Page":[{"Id":"MN2PG43094","Url":"http:\/\/selfridges.cloudopsguys.com\/","Label":"Selfridges via aiCache only","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43095","Url":"http:\/\/www.selfridges.com\/","Label":"Selfridges Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43509","Url":"https:\/\/airbnb-uk.cloudopsguys.com\/","Label":"AirBnB UK aiCache","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43508","Url":"https:\/\/www.airbnb.co.uk\/","Label":"AirBnB UK Direct","CurrentStatus":"OK","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43098","Url":"http:\/\/selfridges.cloudopsguys.com:81\/","Label":"Selfridges via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43099","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/","Label":"Selfridges via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43100","Url":"http:\/\/selfridges-aptimized.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache & Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43101","Url":"http:\/\/selfridges.cloudopsguys.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via aiCache","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43102","Url":"http:\/\/selfridges.cloudopsguys.com:81\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category via Stingray","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"},{"Id":"MN2PG43103","Url":"http:\/\/www.selfridges.com\/en\/Womenswear\/Categories\/Shop-Clothing\/Swimwear-beachwear\/","Label":"SLF Category Direct","CurrentStatus":"Warning","DownloadSpeed":"233016","Alerting":"true"}]}}}}';

        $response = $this->getClient(
            '/Return/[Account[AccountId,Name,Pages[Page[Id,Url,Label,CurrentStatus,LastTestDownloadSpeed,Alerting]]]]/AccountId/' . (string) $accounts . '/Format/json'
        );

        return $response;
    }


}