<?php
namespace Application\Model\Entity\Error;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Error implements InputFilterAwareInterface
{

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var int
     */
    protected $reference = 0;

    /**
     * @var int
     */
    protected $statusCode = 0;

    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var int
     */
    protected $duration = 0;

    /**
     * @var string
     */
    protected $notes = '';

    /**
     * @var bool
     */
    protected $open = true;

    /**
     * @var string
     */
    protected $datetime = '';

    /**
     * @var string
     */
    protected $result = '';

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id         = (isset($data['id'])) ? $data['id'] : null;
        $this->reference  = (isset($data['reference'])) ? $data['reference'] : null;
        $this->statusCode = (isset($data['statusCode'])) ? $data['statusCode'] : null;
        $this->status     = (isset($data['status'])) ? $data['status'] : null;
        $this->duration   = (isset($data['duration'])) ? $data['duration'] : null;
        $this->notes      = (isset($data['notes'])) ? $data['notes'] : null;
        $this->open     = (isset($data['open'])) ? $data['open'] : null;
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
     * @param int $duration
     * @return Error
     */
    public function setDuration($duration)
    {
        $this->duration = (int)$duration;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $id
     * @return Error
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
     * @param boolean $open
     * @return Error
     */
    public function setOpen($open)
    {
        $this->open = (bool) $open;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * @param string $notes
     * @return Error
     */
    public function setNotes($notes)
    {
        $this->notes = (string)$notes;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param int $reference
     * @return Error
     */
    public function setReference($reference)
    {
        $this->reference = (int)$reference;

        return $this;
    }

    /**
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $status
     * @return Error
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
     * @param int $statusCode
     * @return Error
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = (int)$statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param string $datetime
     * @return Error
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

    /**
     * @param string $result
     * @return Error
     */
    public function setResult($result)
    {
        $this->result = (string) $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }



}
