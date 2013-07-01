<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Monitor as MonitorEntity;
use Common\Model\Mapper\Core;

/**
 * Class AuthWebService
 *
 * @package Application\Model\Mapper\Auth
 */
class MonitorRest extends Core implements MonitorInterface
{

    /**
     * @param MonitorEntity $monitorEntity
     * @return array
     */
    static public function mapToExternal(MonitorEntity $monitorEntity)
    {
        $data = array(
            'id'            => $monitorEntity->getId(),
            'accountId'     => $monitorEntity->getAccountId(),
            'label'         => $monitorEntity->getLabel(),
            'url'           => $monitorEntity->getUrl(),
            'status'        => $monitorEntity->getStatus(),
            'downloadSpeed' => $monitorEntity->getDownloadSpeed(),
            'alerting' => $monitorEntity->getAlerting(),
            'created_on'    => $monitorEntity->getCreatedOn(),
        );

        return $data;
    }

    /**
     * @param array $data
     * @param string      $accountId
     * @return MonitorEntity $monitorEntity
     */
    static public function mapToInternal(array $data, $accountId)
    {
        $monitorEntity = new MonitorEntity;
        $monitorEntity->setId($data['Id'])
            ->setAccountId($accountId)
            ->setLabel($data['Label'])
            ->setUrl($data['Url'])
            ->setStatus($data['CurrentStatus'])
            ->setDownloadSpeed($data['DownloadSpeed'])
            ->setAlerting($data['Alerting']);
            //->setCode($data['Response']['Code']);
            //->setCreatedOn($data['Response']['created_on']);

        return $monitorEntity;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();

        $monitors = array();
        foreach ($response['Response']['Account']['Pages']['Page'] as $monitor) {
            $monitors[] = self::mapToInternal($monitor, $response['Request']['AccountId']);
        }

        return $monitors;
    }


}