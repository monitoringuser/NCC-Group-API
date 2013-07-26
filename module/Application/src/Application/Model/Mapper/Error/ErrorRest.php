<?php
namespace Application\Model\Mapper\Error;

use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Account\AccountCollection;
use Application\Model\Entity\Error\Error as ErrorEntity;
use Application\Model\Entity\Error\ErrorCollection;
use Application\Model\Entity\Monitor\Monitor as MonitorEntity;
use Application\Model\Mapper\Monitor\MonitorRest as MonitorMapper;
use Application\Model\Entity\Monitor\MonitorCollection;
use Application\Model\Mapper\Account\AccountRest as AccountMapper;
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
     * @return bool $errorEntity
     */
    static public function mapToInternal(array $data, $isOpen = true)
    {
        $errorEntity = new ErrorEntity;
        $errorEntity->setId($data['Id'])
            ->setReference($data['Ref'])
            ->setStatusCode($data['StatusCode'])
            ->setStatus($data['Status'])
            ->setDuration($data['Duration'])
           // ->setNotes($data['Notes'])
            ->setDatetime($data['LocalDateTime'])
            ->setResult($data['Result'])
            ->setOpen($isOpen);

        return $errorEntity;
    }

    /**
     * @param array $response
     * @return AccountCollection
     */
    static private function mapAllToInternal(array $response)
    {
        // crude fix for inconsistent returned data
        if(!empty($response['Response']['Account']['AccountId'])) {
            $response['Response']['Account'] = array($response['Response']['Account']);
        }

        $accountCollection = new AccountCollection();
        foreach($response['Response']['Account'] as $account) {
            $accountEntity = AccountMapper::mapToInternal($account);


            // crude fix for inconsistent returned data
            if(!empty($account['Pages']['Page']['Id'])) {
                $account['Pages']['Page'] = array($account['Pages']['Page']);
            }

            // fix for incomplete response, requires investigation
            if(empty($account['Pages']['Page'])) {
                break;
            }

            $monitorCollection = new MonitorCollection();
            foreach($account['Pages']['Page'] as $monitor) {
                $monitorEntity = MonitorMapper::mapToInternal($monitor);

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

                $monitorCollection->addMonitor(
                    $monitorEntity->setErrors($errorCollection)
                );
            }
            $accountCollection->addAccount(
                $accountEntity->setMonitors($monitorCollection)
            );
        }

        return $accountCollection;
    }

    /**
     * @return AccountCollection
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();

        return self::mapAllToInternal($response);
    }

    /**
     * @param MonitorEntity $monitorEntity
     * @return MonitorEntity
     */
    public function findAllByMonitorId(MonitorEntity $monitorEntity)
    {
        $response = $this->getDao()->findAllByMonitorId($monitorEntity->getId());

        return self::mapAllToInternal($response);
    }


}