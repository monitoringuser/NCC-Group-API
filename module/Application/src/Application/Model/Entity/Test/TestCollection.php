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


}