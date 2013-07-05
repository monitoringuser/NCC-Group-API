<?php
namespace Application\Model\Entity\Account;

use Application\Model\Entity\Monitor\MonitorCollection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Account implements InputFilterAwareInterface
{
    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $testStartDate = '';

    /**
     * @var string
     */
    protected $testEndDate = '';

    /**
     * @var array
     */
    protected $monitors = array();

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
        $this->monitors = (isset($data['monitors'])) ? $data['monitors'] : null;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Account
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * @return MonitorCollection
     */
    public function getMonitors()
    {
        return $this->monitors;
    }

    /**
     * @param MonitorCollection $monitors
     * @return Account
     */
    public function setMonitors(MonitorCollection $monitors)
    {
        $this->monitors = $monitors;

        return $this;
    }

    /**
     * @param string $testEndDate
     * @return Account
     */
    public function setTestEndDate($testEndDate)
    {
        $this->testEndDate = (string)$testEndDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getTestEndDate()
    {
        if (empty($this->testEndDate)) {
            $date              = new \DateTime();
            $this->testEndDate = $date->format('Y-m-d H:i:s');
        }

        return $this->testEndDate;
    }

    /**
     * @param string $testStartDate
     * @return Account
     */
    public function setTestStartDate($testStartDate)
    {
        $this->testStartDate = (string)$testStartDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getTestStartDate()
    {
        if (empty($this->testEndDate)) {
            $date = new \DateTime();
            $date->sub(new \DateInterval('P1D'));
            $this->testEndDate = $date->format('Y-m-d H:i:s');
        }

        return $this->testStartDate;
    }


}