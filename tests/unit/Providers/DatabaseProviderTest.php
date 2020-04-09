<?php
declare(strict_types=1);

namespace App\Tests\Unit\Providers;

use Codeception\Test\Unit;
use App\Providers\DatabaseProvider;
use Phalcon\Di\ServiceProviderInterface;

final class DatabaseProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(DatabaseProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
