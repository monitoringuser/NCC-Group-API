<?php
namespace Application\Model\Mapper\Monitor;

use Application\Model\Entity\Account\AccountCollection;
use Application\Model\Entity\Account\Account as AccountEntity;
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
     * @param AccountCollection $accountCollectionRequest
     * @return AccountCollection
     */
    public function findAllByAccounts(AccountCollection $accountCollectionRequest)
    {
        $accounts = array();
        foreach ($accountCollectionRequest->getAccounts() as $accountEntityRequest) {
            $accounts[] = $accountEntityRequest->getId();
        }
        $accounts = implode(',', $accounts);

        $response = $this->getDao()->findAllByAccounts($accounts);

        $accountCollectionResponse = new AccountCollection;

        // multiple account response
        if (!empty($response['Response']['Account'][0])) {
            foreach ($response['Response']['Account'] as $account) {
                $accountEntityResponse = new AccountEntity;
                $accountEntityResponse->setId($account['AccountId']);

                $monitorCollection = new MonitorCollection;
                foreach ($account['Pages']['Page'] as $monitor) {
                    $monitorCollection->addMonitor(self::mapToInternal($monitor));
                }
                $accountCollectionResponse->addAccount(
                    $accountEntityResponse->setMonitors($monitorCollection)
                );
            }
        } else {
            // single account response
            $account = $response['Response']['Account'];
            $accountEntityResponse = new AccountEntity;
            $accountEntityResponse->setId($account['AccountId']);

            $monitorCollection = new MonitorCollection;
            foreach ($account['Pages']['Page'] as $monitor) {
                $monitorCollection->addMonitor(self::mapToInternal($monitor));
            }
            $accountCollectionResponse->addAccount(
                $accountEntityResponse->setMonitors($monitorCollection)
            );
        }

        return $accountCollectionResponse;
    }


}