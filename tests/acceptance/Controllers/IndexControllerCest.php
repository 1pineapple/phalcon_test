<?php
declare(strict_types=1);

namespace App\Tests\Acceptance\Controllers;

use AcceptanceTester;

final class IndexControllerCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function testIndex(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('Welcome to Test Task');
    }
}
