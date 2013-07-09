<?php
namespace Application\Model\Entity\Test;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Test implements InputFilterAwareInterface
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var float
     */
    protected $totalSeconds = 0;

    /**
     * @var string
     */
    protected $datetime = '';

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->totalSeconds = (isset($data['totalSeconds'])) ? $data['totalSeconds'] : null;
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
     * @return float
     */
    public function getTotalSeconds()
    {
        return $this->totalSeconds;
    }

    /**
     * @param float $totalSeconds
     * @return Test
     */
    public function setTotalSeconds($totalSeconds)
    {
        $this->totalSeconds = (float) $totalSeconds;

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
     * @param string $id
     * @return Test
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $datetime
     * @return Test
     */
    public function setDatetime($datetime)
    {
        $this->datetime = (string) $datetime;

        return $this;
    }

    /**
     * @return string
     */
    public function getDatetime()
    {
        return $this->datetime;
    }


}