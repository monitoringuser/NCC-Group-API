<?php
namespace Application\Model\Mapper\Account;

use Application\Model\Entity\Account\Account as AccountEntity;
use Application\Model\Entity\Account\AccountCollection;
use Common\Model\Mapper\Core;

/**
 * Class TestRest
 *
 * @package Application\Model\Mapper\Auth
 */
class AccountRest extends Core implements AccountInterface
{

    /**
     * @param AccountEntity $accountEntity
     * @return array
     */
    static public function mapToExternal(AccountEntity $accountEntity)
    {
        $data = array(
            'id'       => $accountEntity->getId(),
            'name'     => $accountEntity->getName()
        );

        return $data;
    }

    /**
     * @param array  $data
     * @return AccountEntity $accountEntity
     */
    static public function mapToInternal(array $data)
    {
        $accountEntity = new AccountEntity;
        $accountEntity->setId($data['AccountId'])
            ->setName($data['Name']);

        return $accountEntity;
    }

    /**
     * @return AccountCollection
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();

        $accountCollection = new AccountCollection;

        // multiple account response
        if (!empty($response['Response']['Account'][0])) {
            foreach ($response['Response']['Account'] as $account) {
                $accountCollection->addAccount(self::mapToInternal($account));
            }
        } else {
            // single account response
            $accountCollection->addAccount(self::mapToInternal($response['Response']['Account']));
        }

        return $accountCollection;
    }


}