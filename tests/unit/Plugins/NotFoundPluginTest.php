<?php
declare(strict_types=1);

namespace App\Tests\Unit\Plugins;

use Codeception\Test\Unit;
use App\Plugins\NotFoundPlugin;
use Phalcon\Di\Injectable;

final class NotFoundPluginTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(NotFoundPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
