<?php
namespace Application\Model\Mapper\Account;

use Application\Model\Entity\Account as AccountEntity;
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
     * @return array
     */
    public function findAll()
    {
        $response = $this->getDao()->findAll();
// @TODO single account does not return array???
//var_dump($response['Response']['Account']); exit;
        //$accounts = array();
        //foreach ($response['Response'] as $account) {
            //$accounts[] = self::mapToInternal($account);
            $accounts[] = self::mapToInternal($response['Response']['Account']);
        //}

        return $accounts;
    }


}