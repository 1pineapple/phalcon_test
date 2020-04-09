<?php
declare(strict_types=1);

namespace App\Tests\Unit\Models;

use Codeception\Test\Unit;
use App\Models\Users;
use Phalcon\Mvc\Model;

final class UsersTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(Users::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
