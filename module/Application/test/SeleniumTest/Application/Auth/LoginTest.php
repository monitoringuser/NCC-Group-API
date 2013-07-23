<?php
namespace ApplicationTest\SelemiumTest\Application\Auth;

use ApplicationTest\SelemiumTest\Application\Core;
use ApplicationTest\Page\Application\Auth\Login as LoginPage;

class LoginTest extends Core
{

    /**
     * @var LoginPage
     */
    protected $page;

    public function setUp()
    {
        parent::setUp();

        $this->page = new LoginPage;
    }

    /**
     * Test form exists
     */
    public function testFormExists()
    {
        $this->session->open("http://gh.ncc-group-api");

        $email = $this->session->elements('xpath', $this->page->getEmail());
        $this->assertEquals(count($email), 1);

        $password = $this->session->elements('xpath', $this->page->getPassword());
        $this->assertEquals(count($password), 1);

        $submit = $this->session->elements('xpath', $this->page->getSubmit());
        $this->assertEquals(count($submit), 1);
    }

}