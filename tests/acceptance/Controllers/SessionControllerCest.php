<?php


namespace App\Tests\Acceptance\Controllers;

use AcceptanceTester;


final class SessionControllerCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function testIndex(AcceptanceTester $I): void
    {
        $I->amOnPage('/session/index');
        $I->see('Log In');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function testEnd(AcceptanceTester $I): void
    {
        $I->amOnPage('/session/end');
        $I->see('Goodbye');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function testStart(AcceptanceTester $I): void
    {
        $I->amOnPage('/session/end');
        $I->see('Goodbye');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function testLogoutAsUser(AcceptanceTester $I): void
    {
        $I->amOnPage('/session/index');
        $I->see('Log In');
        $I->fillField('login', 'demo');
        $I->fillField('password', 'phalcon');
        $I->click('input[type=submit]');
        $I->see('Welcome demo');
        $I->amOnPage('/session/end');
        $I->see('Goodbye!');
    }
}