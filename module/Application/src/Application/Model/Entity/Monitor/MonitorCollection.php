<?php
namespace Application\Model\Entity\Monitor;

/**
 * Class MonitorCollection
 *
 * This will manage multiple monitors with the benefit of extra functionality
 * Extra functionality will be added as required (i.e. sorting)
 *
 * @package Application\Model\Entity\Monitor
 */
class MonitorCollection
{

    /**
     * @var array
     */
    protected $monitors;

    /**
     * @var string
     */
    protected $startDate = '';

    /**
     * @var string
     */
    protected $endDate = '';

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
    public function getIdsAsArray() {
        return array_keys($this->getMonitors());
    }

    /**
     * Alias for getMonitors()
     *
     * @return array
     */
    public function getData()
    {
        return $this->getMonitors();
    }

    /**
     * @return array
     */
    public function getMonitors()
    {
        return $this->monitors;
    }

    /**
     * @param array $monitors
     * @return MonitorCollection
     */
    public function setMonitors(array $monitors)
    {
        $this->monitors = $monitors;

        return $this;
    }

    /**
     * @param Monitor $monitor
     * @return MonitorCollection
     */
    public function addMonitor(Monitor $monitor)
    {
        $this->monitors[$monitor->getId()] = $monitor;

        return $this;
    }

    /**
     * @param Monitor $monitor
     * @return Monitor|null
     */
    public function getMonitor(Monitor $monitor)
    {
        if (!empty($this->monitors[$monitor->getId()])) {
            return $this->monitors[$monitor->getId()];
        }

        return null;
    }

    /**
     * @param Monitor $monitor
     * @return bool
     */
    public function removeMonitor(Monitor $monitor)
    {
        if (!empty($this->monitors[$monitor->getId()])) {
            unset($this->monitors[$monitor->getId()]);
            return true;
        }

        return false;
    }

    /**
     * @param Monitor $monitor
     * @return bool
     */
    public function hasMonitor(Monitor $monitor)
    {
        if (!empty($this->monitors[$monitor->getId()])) {
            return true;
        }

        return false;
    }

    /**
     * @param string $endDate
     * @return MonitorCollection
     */
    public function setEndDate($endDate)
    {
        $this->endDate = (string) $endDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        if (empty($this->endDate)) {
            $date = new \DateTime();
            $this->endDate = $date->format('Y-m-d H:i:s');
        }
        return $this->endDate;
    }

    /**
     * @param string $startDate
     * @return MonitorCollection
     */
    public function setStartDate($startDate)
    {
        $this->startDate = (string) $startDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        if (empty($this->startDate)) {
            $date = new \DateTime();
            $date->sub(new \DateInterval('P7D'));
            $this->startDate = $date->format('Y-m-d H:i:s');
        }
        return $this->startDate;
    }




}