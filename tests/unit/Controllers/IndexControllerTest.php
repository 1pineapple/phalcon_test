<?php
declare(strict_types=1);

namespace App\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use App\Controllers\IndexController;
use Phalcon\Mvc\Controller;

final class IndexControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(IndexController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
