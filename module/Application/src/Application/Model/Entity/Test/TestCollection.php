<?php
namespace Application\Model\Entity\Test;

/**
 * Class TestCollection
 *
 * This will manage multiple tests with the benefit of extra functionality
 * Extra functionality will be added as required (i.e. sorting)
 *
 * @package Application\Model\Entity\Test
 */
class TestCollection
{

    /**
     * @var array
     */
    protected $tests;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var int
     */
    protected $limit = 100;

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @var string
     */
    protected $startDate = '';

    /**
     * @var string
     */
    protected $endDate = '';

    /**
     * @return string
     */
    public function getDateRange()
    {
        return $this->getStartDate() . ' - ' . $this->getEndDate();
    }

    /**
     * Alias for getAccounts()
     *
     * @return array
     */
    public function getData()
    {
        return $this->getTests();
    }

    /**
     * @return array
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param array $tests
     * @return TestCollection
     */
    public function setTests(array $tests)
    {
        $this->tests = $tests;

        return $this;
    }

    /**
     * @param Test $test
     * @return TestCollection
     */
    public function addTest(Test $test)
    {
        $this->tests[$test->getId()] = $test;

        return $this;
    }

    /**
     * @param Test $test
     * @return Test|null
     */
    public function getTest(Test $test)
    {
        if (!empty($this->tests[$test->getId()])) {
            return $this->tests[$test->getId()];
        }

        return null;
    }

    /**
     * @param Test $test
     * @return bool
     */
    public function removeTest(Test $test)
    {
        if (!empty($this->tests[$test->getId()])) {
            unset($this->tests[$test->getId()]);
            return true;
        }

        return false;
    }

    /**
     * @param Test $test
     * @return bool
     */
    public function hasTest(Test $test)
    {
        if (!empty($this->tests[$test->getId()])) {
            return true;
        }

        return false;
    }

    /**
     * @param int $count
     * @return TestCollection
     */
    public function setCount($count)
    {
        $this->count = (int) $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $limit
     * @return TestCollection
     */
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $offset
     * @return TestCollection
     */
    public function setOffset($offset)
    {
        $this->offset = (int) $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param string $endDate
     * @return TestCollection
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
     * @return TestCollection
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
            $date->sub(new \DateInterval('P1D'));
            $this->startDate = $date->format('Y-m-d H:i:s');
        }
        return $this->startDate;
    }


}