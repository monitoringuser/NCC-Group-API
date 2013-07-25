<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Account\AccountCollection;
use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Mapper\Account\AccountRest as AccountMapper;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Entity\Monitor\MonitorCollection;
use Application\Model\Entity\User as UserEntity;
use Application\Model\Mapper\Test\TestRest as TestMapper;
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
            'id'         => $monitorEntity->getId(),
            'label'      => $monitorEntity->getLabel(),
            'url'        => $monitorEntity->getUrl(),
            'status'     => $monitorEntity->getStatus(),
            'latestTest' => $monitorEntity->getLatestTest(),
            'tests'      => $monitorEntity->getTests(),
            'created_on' => $monitorEntity->getCreatedOn(),
        );

        return $data;
    }

    /**
     * @param array  $data
     * @return MonitorEntity $monitorEntity
     */
    static public function mapToInternal(array $data)
    {
        $monitorEntity = new MonitorEntity;
        $monitorEntity->setId($data['Id'])
            ->setUrl($data['Url'])
            ->setLabel($data['Label'])
            ->setStatus($data['CurrentStatus'])
            ->setLatestTest(
                TestMapper::mapToInternal(
                    array(
                        'Id'           => '',
                        'TotalSeconds' => $data['LastTestDownloadSpeed']
                    )
                )
            )
            ->setAlerting($data['Alerting']);

        return $monitorEntity;
    }

    /**
     * @param array $data
     * @return MonitorCollection $monitorCollection
     */
    static public function mapToCollection(array $data)
    {
        $monitorCollection = new MonitorCollection();
        foreach($data as $monitor) {
            $monitorCollection->addMonitor(self::mapToInternal($monitor));
        }

        return $monitorCollection;
    }

    /**
     * @param AccountCollection $accountCollectionRequest
     * @return AccountCollection
     */
    public function findAllByAccounts(AccountCollection $accountCollectionRequest)
    {
        $accounts = implode(',', $accountCollectionRequest->getIdsAsArray());

        $response = $this->getDao()->findAllByAccounts($accounts);

        // single account response fix
        if (!empty($response['Response']['Account']['AccountId'])) {
            $response['Response']['Account'] = array($response['Response']['Account']);
        }

        $accountCollectionResponse = new AccountCollection;
        foreach ($response['Response']['Account'] as $account) {
            $accountEntityResponse = AccountMapper::mapToInternal($account);

            $accountCollectionResponse->addAccount(
                $accountEntityResponse->setMonitors(
                    self::mapToCollection($account['Pages']['Page'])
                )
            );
        }

        return $accountCollectionResponse;
    }


}