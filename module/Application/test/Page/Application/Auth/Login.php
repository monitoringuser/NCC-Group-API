<?php
namespace ApplicationTest\Page\Application\Auth;

/**
 * Class Login
 *
 * @package Test\Page\Application\Auth
 */
class Login
{

    /**
     * @var string
     */
    protected $email = '/html/body/div[2]/div[3]/div/form/div/div/input';

    /**
     * @var string
     */
    protected $password = '/html/body/div[2]/div[3]/div/form/div[2]/div/input';

    /**
     * @var string
     */
    protected $submit = '//*[@id="submitbutton"]';

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSubmit()
    {
        return $this->submit;
    }


}