<?php
namespace App\Tests\Navigation;
use App\Tests\AcceptanceTester;
use App\Tests\Page\Startpage;

class mainCest
{
    public function _before(AcceptanceTester $I, Startpage $page)
    {
        $I->amOnPage($page::$URL);
        $I->waitForElement($page::$navMainBurgerOpener);
    }

    public function openCloseNav(AcceptanceTester $I, Startpage $page)
    {
        $I->dontSeeElement($page::$navMain);
        $I->click($page::$navMainBurgerOpener);
        $I->waitForElementVisible($page::$navMain);
        $I->click($page::$navMainBurgerHider);
        $I->waitForElementNotVisible($page::$navMain);
    }
}
