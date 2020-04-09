<?php
declare(strict_types=1);

namespace App\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use App\Controllers\SessionController;
use Phalcon\Mvc\Controller;

final class SessionControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(SessionController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
