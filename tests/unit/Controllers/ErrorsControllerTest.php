<?php
declare(strict_types=1);

namespace App\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use App\Controllers\ErrorsController;
use Phalcon\Mvc\Controller;

final class ErrorsControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ErrorsController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
