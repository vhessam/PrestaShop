<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace LegacyTests\PrestaShopBundle\Translation\Provider;

use PHPUnit\Framework\TestCase;
use PrestaShopBundle\Translation\Provider\SearchProvider;

/**
 * @group sf
 */
class SearchProviderTest extends TestCase
{
    /** @see /resources/translations/en-US/AdminActions.en-US.xlf */
    private $provider;
    private static $resourcesDir;

    protected function setUp()
    {
        $loader = $this->getMockBuilder('Symfony\Component\Translation\Loader\LoaderInterface')
            ->getMock();

        self::$resourcesDir = __DIR__.'/../../resources/translations';
        $this->provider = new SearchProvider($loader, self::$resourcesDir);

        $this->provider->setDomain('AdminActions');
    }

    public function testGetMessageCatalogue()
    {
        // The xliff file contains 38 keys
        $expectedReturn = $this->provider->getMessageCatalogue();
        $this->assertInstanceOf('Symfony\Component\Translation\MessageCatalogue', $expectedReturn);

        // Check integrity of translations
        $this->assertArrayHasKey('AdminActions.en-US', $expectedReturn->all());

        $adminTranslations = $expectedReturn->all('AdminActions.en-US');
        $this->assertCount(38, $adminTranslations);
        $this->assertArrayHasKey('Download file', $adminTranslations);
        $this->assertSame('Download file', $adminTranslations['Download file']);
    }
}
