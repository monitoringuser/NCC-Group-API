<?php
namespace Application\Model\Entity\Account;

/**
 * Class AccountCollection
 *
 * This will manage multiple accounts with the benefit of extra functionality
 * Extra functionality will be added as required (i.e. sorting)
 *
 * @package Application\Model\Entity\Account
 */
class AccountCollection
{

    /**
     * @var array
     */
    protected $accounts = array();

    /**
     * Alias for getAccounts()
     *
     * @return array
     */
    public function getData()
    {
        return $this->getAccounts();
    }

    /**
     * @return array
     */
    public function getIdsAsArray() {
        return array_keys($this->getAccounts());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param array $accounts
     * @return AccountCollection
     */
    public function setAccounts(array $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @param Account $account
     * @return AccountCollection
     */
    public function addAccount(Account $account)
    {
        $this->accounts[$account->getId()] = $account;

        return $this;
    }

    /**
     * @param Account $account
     * @return Account|null
     */
    public function getAccount(Account $account)
    {
        if (!empty($this->accounts[$account->getId()])) {
            return $this->accounts[$account->getId()];
        }

        return null;
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function removeAccount(Account $account)
    {
        if (!empty($this->accounts[$account->getId()])) {
            unset($this->accounts[$account->getId()]);
            return true;
        }

        return false;
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function hasAccount(Account $account)
    {
        if (!empty($this->accounts[$account->getId()])) {
            return true;
        }

        return false;
    }


}