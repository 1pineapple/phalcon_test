<?php


namespace App\Tests\Functional\Models;


use App\Models\Users;
use Codeception\Test\Unit;
use Phalcon\Di;
use Phalcon\Db\RawValue;
use Phalcon\Mvc\Model\Manager;

final class UsersTest extends Unit
{
    public function setUp(): void
    {
        Di::reset();
    }

    public function testBeforeCreate(): void
    {
        $di = new Di();
        $di['modelsManager'] = function () {
            return new Manager();
        };

        $class = new Users();
        $class->setDI($di);
        $class->beforeCreate();

        /** @var RawValue $raw */
        $raw = $class->created_at;

        $this->assertSame('now()', $raw->__toString());

        /** @var RawValue $raw */
        $raw = $class->updated_at;

        $this->assertSame('now()', $raw->__toString());
    }
}