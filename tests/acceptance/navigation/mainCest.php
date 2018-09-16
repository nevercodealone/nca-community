<?php
namespace App\Tests\navigation;
use App\Tests\AcceptanceTester;
use App\Tests\Helper\Config;
use App\Tests\Page\startpage;

class mainCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->waitForElement('h1');
    }

    public function validateInternalAndExternalLinkTargets(AcceptanceTester $I, Config $helperConfig)
    {
        return;
        $specialLinks = [
            'tel:+',
            'mailto',
            'sms',
            'https://symfony.com/doc',
            'http://symfony.com/support'
        ];

        $specialLinksSame = [
            '#'
        ];

        $url = $helperConfig->getUrlFromConfigWebdriver('url');

        $items = $I->grabMultiple('a', 'href');
        $itemsTargets = $I->grabMultiple('a', 'target');
        $itemsRel = $I->grabMultiple('a', 'rel');

        foreach ($items as $key => $item) {
            if($item === null) {
                continue;
            }

            if(strpos($item, $url) === false) {
                foreach ($specialLinks as $specialLinkKey => $specialLink) {
                    if(strpos($item, $specialLink) !== false || strstr($specialLinksSame[$specialLinkKey], $specialLink)) {
                        $I->assertSame('', $itemsTargets[$key], 'Item no blank: ' . $item . '|' . $key);
                        continue 2;
                    }
                }
                $I->assertSame('noopener', $itemsRel[$key], 'Item rel is noopener ' . $item . '|' . $key);
                $I->assertSame('_blank', $itemsTargets[$key], 'Item blank: ' . $item . '|' . $key);
            } else {
                $I->assertSame('', $itemsTargets[$key], 'Item no blank: ' . $item . '|' . $key);
            }
        }
    }
}
