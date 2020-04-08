<?php


namespace App\Forms;


use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

class UsersForm extends Form
{
    /**
     * Initialize the users form
     *
     * @param null $entity
     * @param array $options
     */

    public function initialize($entity = null, array $options = [])
    {
        if (isset($options['edit'])) {
            $this->add(new Hidden('id'));
        }
        $login = new Text('login');
        $login->setLabel('Login');
        $login->setFilters(['striptags', 'string']);
        $login->addValidators([
            new PresenceOf(['message' => 'Login is required']),
        ]);
        $this->add($login);

        $password = new Password('password');
        $password->setLabel('Password');
        $password->setFilters(['string']);
        $password->addValidators([
            new PresenceOf(['message' => 'Password is required']),
        ]);
        $this->add($password);


    }

}