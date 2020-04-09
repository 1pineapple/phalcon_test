<?php


namespace App\Tests\Unit\Controllers;


use App\Controllers\UsersController;
use Codeception\Test\Unit;
use Phalcon\Mvc\Controller;

final class UsersControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(UsersController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}