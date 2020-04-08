<?php

declare(strict_types=1);


namespace App\Tasks;

use Phalcon\Cli\Task;


class MainTask extends Task
{
    public function mainAction()
    {
        echo 'You can use this commands:' . PHP_EOL;
        echo 'php run init - initialization project' . PHP_EOL;
        echo 'php run create user --login=test_user --password=plain_password --roles=create,update,list,delete - create new record in db' . PHP_EOL;
    }

}