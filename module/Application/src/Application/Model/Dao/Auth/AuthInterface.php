<?php
namespace Application\Model\Dao\Auth;

/**
 * Class AuthInterface
 *
 * @package Application\Model\Dao\Auth
 */
interface AuthInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data);

}