<?php
namespace Application\Form;

use Zend\Form\Form;

/**
 * Class LoginForm
 *
 * @package Application\Form
 */
class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');
        $this->setAttribute('method', 'post');

        $this->add(
            array(
                'name'       => 'email',
                'attributes' => array(
                    'type' => 'text',
                    'placeholder' => 'john@smith.com'
                ),
                'options'    => array(
                    'label' => 'Email',
                ),
            )
        );

        $this->add(
            array(
                'name'       => 'password',
                'attributes' => array(
                    'type' => 'password',
                ),
                'options'    => array(
                    'label' => 'Password',
                ),
            )
        );

        $this->add(
            array(
                'name'       => 'submit',
                'attributes' => array(
                    'type'  => 'submit',
                    'value' => 'Go',
                    'id'    => 'submitbutton',
                    'class' => 'btn'
                ),
                'options'    => array(
                    'label' => 'GO'
                )
            )
        );
    }
}