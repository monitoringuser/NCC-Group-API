<?php
namespace Application\Model\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
    /**
     * @var string
     */
    protected $id = '';
    /**
     * @var string
     */
    protected $email = '';
    /**
     * @var string
     */
    protected $password = '';
    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var int
     */
    protected $code = 0;

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
        $this->id        = (isset($data['id'])) ? $data['id'] : null;
        $this->email     = (isset($data['email'])) ? $data['email'] : null;
        $this->password  = (isset($data['password'])) ? $data['password'] : null;
        $this->status    = (isset($data['status'])) ? $data['status'] : null;
        $this->code    = (isset($data['code'])) ? $data['code'] : null;
        $this->createdOn = (isset($data['created_on'])) ? $data['created_on'] : null;
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
                        'name'       => 'email',
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

            $inputFilter->add(
                $factory->createInput(
                    array(
                        'name'       => 'password',
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
     * @return string
     */
    public function getCreatedOn()
    {
        if (empty($this->createdOn)) {
            $datetime        = new \DateTime('now');
            $this->createdOn = $datetime->format('Y-m-d H:i:s');
        }

        return $this->createdOn;
    }

    /**
     * @param $createdOn
     *
     * @return User
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = (string)$createdOn;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = (string)$email;

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
     * @return User
     */
    public function setId($id)
    {
        $this->id = (string)$id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = (string)$password;

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
     * @param string $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = (string)$status;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return User
     */
    public function setCode($code)
    {
        $this->code = (int) $code;
        return $this;
    }


}