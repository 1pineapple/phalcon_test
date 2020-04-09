<?php


namespace App\Tests\Acceptance\Controllers;

use AcceptanceTester;


final class UsersControllerCest
{
    private $cookie = null;

    /**
     * @param AcceptanceTester $I
     */
    public function login(AcceptanceTester $I): void
    {
        $I->amOnPage('/session/index');
        $I->see('Log In');
        $I->fillField('login', 'demo');
        $I->fillField('password', 'phalcon');
        $I->click('input[type=submit]');
        $I->see('Welcome demo');

        $this->cookie = $I->grabCookie('PHPSESSID');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function testIndexAsGuest(AcceptanceTester $I): void
    {
        $I->amOnPage('/users');
        $I->see('Unauthorized');
    }

    /**
     * @depends login
     * @param AcceptanceTester $I
     */
    public function testIndex(AcceptanceTester $I): void
    {
        $I->setCookie('PHPSESSID', $this->cookie);

        $I->amOnPage('/users');
        $I->see('List Users');
    }

    /**
     * @depends login
     * @param AcceptanceTester $I
     */
    public function testCreate(AcceptanceTester $I): void
    {
        $I->setCookie('PHPSESSID', $this->cookie);

        $I->amOnPage('/users/new');
        $I->see('Add new user');
    }

    /**
     * @depends login
     * @param AcceptanceTester $I
     */
    public function testEdit(AcceptanceTester $I): void
    {
        $I->setCookie('PHPSESSID', $this->cookie);

        $I->amOnPage('/users/edit/1');
        $I->see('Edit user');
    }
}