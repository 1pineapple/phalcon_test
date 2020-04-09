<?php
declare(strict_types=1);

namespace App\Tests\Unit\Providers;

use Codeception\Test\Unit;
use App\Providers\ConfigProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ConfigProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ConfigProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
