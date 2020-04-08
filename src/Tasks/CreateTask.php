<?php


namespace App\Tasks;


use App\Models\Users;
use Phalcon\Cli\Task;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

class CreateTask extends Task
{
    public function userAction(string $login, string $password, string $roles)
    {
        $user = new Users();
        $user->login = explode("=",$login)[1];
        $user->password = sha1(explode("=",$login)[1]);
        $user->roles = json_encode(explode(",",explode("=",$roles)[1]));
        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                echo (string) $message;
            }
        } else {
            echo "User created successful".PHP_EOL;
        }
    }
}