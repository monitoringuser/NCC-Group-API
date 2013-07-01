<?php
namespace Application\Model\Service\Exception;

use Zend\Authentication\Exception\ExceptionInterface as Exception;

class AuthenticationError extends \Exception implements Exception
{

}