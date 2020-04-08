<?php


namespace App\Tasks;


use Phalcon\Cli\Task;

class InitTask extends Task
{
    public function mainAction()
    {
        $output = shell_exec('vendor/bin/phalcon-migrations run --config=migrations.php');
        echo $output;
    }
}