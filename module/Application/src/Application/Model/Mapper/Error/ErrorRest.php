<?php
namespace Application\Model\Mapper\Error;

use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Account\AccountCollection;
use Application\Model\Entity\Error\Error as ErrorEntity;
use Application\Model\Entity\Error\ErrorCollection;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Entity\Monitor\MonitorCollection;
use Application\Model\Mapper\Error\ErrorInterface;
use Common\Model\Mapper\Core;

/**
 * Class ErrorRest
 *
 * @package Application\Model\Mapper\Auth
 */
class ErrorRest extends Core implements ErrorInterface
{

    /**
     * @param ErrorEntity $errorEntity
     * @return array
     */
    static public function mapToExternal(ErrorEntity $errorEntity)
    {
        $data = array(
            'id'         => $errorEntity->getId(),
            'reference'  => $errorEntity->getReference(),
            'statusCode' => $errorEntity->getStatusCode(),
            'status'     => $errorEntity->getStatus(),
            'duration'   => $errorEntity->getDuration(),
            'notes'      => $errorEntity->getNotes(),
            'open'       => $errorEntity->isOpen()
        );

        return $data;
    }

    /**
     * @param array $data
     * @param bool  $isOpen
     * @return ErrorEntity $errorEntity
     */
    static public function mapToInternal(array $data, $isOpen = true)
    {
        $errorEntity = new ErrorEntity;
        $errorEntity->setId($data['Id'])
            ->setReference($data['Ref'])
            ->setStatusCode($data['StatusCode'])
            ->setStatus($data['Status'])
            ->setDuration($data['Duration'])
            ->setNotes($data['Notes'])
            ->setDatetime($data['LocalDateTime'])
            ->setResult($data['Result'])
            ->setOpen($isOpen);


        return $errorEntity;
    }

    /**
     * @return AccountCollection
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();

        // crude fix for inconsistent returned data
        if(!empty($response['Response']['Account']['AccountId'])) {
            $response['Response']['Account'] = array($response['Response']['Account']);
        }

        $accountCollection = new AccountCollection();
        foreach($response['Response']['Account'] as $account) {
            $accountEntity = new AccountEntity();
            $accountEntity->setId($account['AccountId'])
                ->setName($account['Name']);

            $monitorCollection = new MonitorCollection();
            foreach($account['Pages']['Page'] as $monitor) {
                $monitorEntity = new MonitorEntity();
                $monitorEntity->setId($monitor['Id'])
                    ->setUrl($monitor['Url'])
                    ->setLabel($monitor['Label'])
                    ->setStatus($monitor['CurrentStatus']);

                $errorCollection = new ErrorCollection();

                // crude fix for inconsistent returned data
                if (!empty($monitor['Errors']['Open']['Error']['Id'])) {
                    $monitor['Errors']['Open']['Error'] = array($monitor['Errors']['Open']['Error']);
                }
                if (!empty($monitor['Errors']['Open']['Error']) && is_array($monitor['Errors']['Open']['Error'])) {
                    foreach($monitor['Errors']['Open']['Error'] as $openErrors) {
                        $errorCollection->addError(self::mapToInternal($openErrors, true));
                    }
                }

                // crude fix for inconsistent returned data
                if (!empty($monitor['Errors']['Closed']['Error']['Id'])) {
                    $monitor['Errors']['Closed']['Error'] = array($monitor['Errors']['Closed']['Error']);
                }
                if (!empty($monitor['Errors']['Closed']['Error']) && is_array($monitor['Errors']['Closed']['Error'])) {
                    foreach($monitor['Errors']['Closed']['Error'] as $closedErrors) {
                        $errorCollection->addError(self::mapToInternal($closedErrors, false));
                    }
                }
                $monitorEntity->setErrors($errorCollection);

                $monitorCollection->addMonitor($monitorEntity);
            }
            $accountEntity->setMonitors($monitorCollection);
            $accountCollection->addAccount($accountEntity);
        }

        return $accountCollection;
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
var_dump($response); exit;
        return $accountCollection;
    }

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorId(MonitorEntity $monitorEntity)
    {
        $response = $this->getDao()->findAllByMonitorId($monitorEntity->getId());
var_dump($response); exit;
        return $monitorEntity;
    }


}