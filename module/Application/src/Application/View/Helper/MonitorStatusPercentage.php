<?php
namespace Application\View\Helper;

use Application\Model\Entity\Account\AccountCollection;
use Zend\View\Helper\AbstractHelper;

/**
 * Class MonitorStatusPercentage
 *
 * @package Application\View\Helper
 */
class MonitorStatusPercentage extends AbstractHelper
{

    /**
     * @var array
     */
    protected $presets = array(
        'OK'      => 0,
        'Warning' => 0,
        'Error'   => 0,
        'Down'    => 0,
        'Total'   => 0
    );

    /**
     * @var array
     */
    protected $states = array();

    /**
     * @var AccountCollection
     */
    protected $accounts;

    /**
     * @param AccountCollection $accounts
     * @return MonitorStatusPercentage
     */
    public function __invoke(AccountCollection $accounts)
    {
        $this->setAccounts($accounts);
        $this->calculate();

        return $this;
    }

    /**
     * @return float
     */
    public function getStateOkAsPercentage()
    {
        return round(($this->states['OK'] / $this->states['Total']) * 100, 1);
    }

    /**
     * @return float
     */
    public function getStateWarningAsPercentage()
    {
        return round(($this->states['Warning'] / $this->states['Total']) * 100, 1);
    }

    /**
     * @return float
     */
    public function getStateErrorAsPercentage()
    {
        return round(($this->states['Error'] / $this->states['Total']) * 100, 1);
    }

    /**
     * @return float
     */
    public function getStateDownAsPercentage()
    {
        return round(($this->states['Down'] / $this->states['Total']) * 100, 1);
    }

    /**
     * @return MonitorStatusPercentage
     */
    public function calculate()
    {
        $this->reset();

        foreach ($this->getAccounts()->getData() as $account) {
            foreach ($account->getMonitors()->getData() as $monitor) {
                $this->states[$monitor->getStatus()]++;
                $this->states['Total']++;
            }
        }

        return $this;
    }

    /**
     * @return MonitorStatusPercentage
     */
    public function reset()
    {
        $this->states = $this->presets;

        return $this;
    }

    /**
     * @param AccountCollection $accounts
     * @return MonitorStatusPercentage
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return AccountCollection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }


}