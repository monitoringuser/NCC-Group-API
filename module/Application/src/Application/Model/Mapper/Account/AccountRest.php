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
     * @param array  $data
     * @return AccountCollection $accountCollection
     */
    static public function mapToCollection(array $data)
    {
        $accountCollection = new AccountCollection();
        foreach ($data as $account) {
            $accountCollection->addAccount(self::mapToInternal($account));
        }

        return $accountCollection;
    }

    /**
     * @return AccountCollection
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();

        // single account response fix
        if (!empty($response['Response']['Account']['AccountId'])) {
            $response['Response']['Account'] = array($response['Response']['Account']);
        }

        $accountCollection = self::mapToCollection($response['Response']['Account']);

        return $accountCollection;
    }


}