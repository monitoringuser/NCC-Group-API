<?php
namespace Application\Model\Entity\Error;

/**
 * Class ErrorCollection
 *
 * This will manage multiple errors with the benefit of extra functionality
 * Extra functionality will be added as required (i.e. sorting)
 *
 * @package Application\Model\Entity\Error
 */
class ErrorCollection
{

    /**
     * @var array
     */
    protected $openErrors = array();

    /**
     * @var array
     */
    protected $closedErrors = array();

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Alias for getMonitors()
     *
     * @return array
     */
    public function getData()
    {
        return $this->getErrors();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return array_merge($this->openErrors, $this->closedErrors);
    }

    /**
     * @return array
     */
    public function getOpenErrors()
    {
        return $this->openErrors;
    }

    /**
     * @return array
     */
    public function getClosedErrors()
    {
        return $this->closedErrors;
    }

    /**
     * @param Error $error
     * @return ErrorCollection
     */
    public function addError(Error $error)
    {
        if ($error->isOpen()) {
            $this->openErrors[$error->getId()] = $error;
        } else {
            $this->closedErrors[$error->getId()] = $error;
        }

        return $this;
    }

    /**
     * @param Error $error
     * @return Error|null
     */
    public function getError(Error $error)
    {
        if (!empty($this->errors[$error->getId()])) {
            return $this->errors[$error->getId()];
        }

        return null;
    }

    /**
     * @param Error $error
     * @return bool
     */
    public function removeError(Error $error)
    {
        if (!empty($this->errors[$error->getId()])) {
            unset($this->errors[$error->getId()]);
            return true;
        }

        return false;
    }

    /**
     * @param Error $error
     * @return bool
     */
    public function hasError(Error $error)
    {
        if (!empty($this->errors[$error->getId()])) {
            return true;
        }

        return false;
    }


}