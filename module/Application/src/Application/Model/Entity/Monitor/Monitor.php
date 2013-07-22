<?php
namespace Application\Model\Entity\Monitor;

use Application\Model\Entity\Error\ErrorCollection;
use Application\Model\Entity\Test\Test;
use Application\Model\Entity\Test\TestCollection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Monitor implements InputFilterAwareInterface
{
    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var string
     */
    protected $label = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var Test
     */
    protected $latestTest;

    /**
     * @var ErrorCollection
     */
    protected $errors;

    /**
     * @var array
     */
    protected $testCollections = array();

    /**
     * @var string
     */
    protected $activeTestCollection;

    /**
     * @var bool
     */
    protected $alerting;

    /**
     * @var string
     */
    protected $createdOn = '';
    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id              = (isset($data['id'])) ? $data['id'] : null;
        $this->label           = (isset($data['label'])) ? $data['label'] : null;
        $this->url             = (isset($data['url'])) ? $data['url'] : null;
        $this->status          = (isset($data['status'])) ? $data['status'] : null;
        $this->latestTest      = (isset($data['latestTest'])) ? $data['latestTest'] : null;
        $this->testCollections = (isset($data['testCollections'])) ? $data['testCollections'] : null;
        $this->alerting        = (isset($data['alerting'])) ? $data['alerting'] : null;
        $this->createdOn       = (isset($data['created_on'])) ? $data['created_on'] : null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @return InputFilter|InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add(
                $factory->createInput(
                    array(
                        'name'       => 'id',
                        'required'   => true,
                        'filters'    => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 5,
                                    'max'      => 64,
                                ),
                            )
                        )
                    )
                )
            );


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    /**
     * @param InputFilterInterface $inputFilter
     *
     * @return void|InputFilterAwareInterface
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * @param string $createdOn
     * @return Monitor
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = (string)$createdOn;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param string $id
     * @return Monitor
     */
    public function setId($id)
    {
        $this->id = (string)$id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     * @return Monitor
     */
    public function setLabel($label)
    {
        $this->label = (string)$label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $status
     * @return Monitor
     */
    public function setStatus($status)
    {
        $this->status = (string)$status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $url
     * @return Monitor
     */
    public function setUrl($url)
    {
        $this->url = (string)$url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param boolean $alerting
     * @return Monitor
     */
    public function setAlerting($alerting)
    {
        $this->alerting = (bool)$alerting;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAlerting()
    {
        return $this->alerting;
    }

    /**
     * @param Test $latestTest
     * @return Monitor
     */
    public function setLatestTest(Test $latestTest)
    {
        $this->latestTest = $latestTest;

        return $this;
    }

    /**
     * @return Test
     */
    public function getLatestTest()
    {
        return $this->latestTest;
    }

    /**
     * @return array
     */
    public function getTestCollections()
    {
        return $this->testCollections;
    }

    /**
     * @param TestCollection $testCollection
     * @return TestCollection
     */
    public function getTestCollectionByCollection(TestCollection $testCollection)
    {
        return $this->testCollections[$testCollection->getDateRange()];
    }

    /**
     * @param TestCollection $testCollection
     * @return Monitor
     */
    public function addTestCollection(TestCollection $testCollection)
    {
        $this->testCollections[$testCollection->getDateRange()] = $testCollection;

        return $this;
    }

    /**
     * @return TestCollection
     */
    public function getFirstTestCollection()
    {
        reset($this->testCollections);
        $firstItemKey = key($this->testCollections);

        return $this->testCollections[$firstItemKey];
    }

    /**
     * Get active test collection
     *
     * If no collection is active, then the first collection is returned
     *
     * @return TestCollection
     */
    public function getActiveTestCollection()
    {
        if (empty($this->activeTestCollection)) {
            return $this->getFirstTestCollection();
        }

        return $this->testCollections[$this->activeTestCollection];
    }

    /**
     * @param TestCollection $activeTestCollection
     * @return Monitor
     */
    public function setActiveTestCollection(TestCollection $activeTestCollection)
    {
        $this->activeTestCollection = $activeTestCollection->getDateRange();

        return $this;
    }

    /**
     * @return ErrorCollection
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param ErrorCollection $errors
     * @return Monitor
     */
    public function setErrors(ErrorCollection $errors)
    {
        $this->errors = $errors;

        return $this;
    }


}