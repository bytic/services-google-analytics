<?php
declare(strict_types=1);

namespace ByTIC\GoogleAnalytics\Tests\Renderer\Script;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsFour;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class AnalyticsJsTest
 * @package ByTIC\GoogleAnalytics\Tests
 */
class AnalyticsFourTest extends AbstractTest
{

    public function testRunEmpty()
    {
        $script = $this->initScript();

        self::assertSame(
            '',
            $script->render()
        );
    }

    public function testGenerateBasic()
    {
        $script = $this->initScript();
        $script->getGoogleAnalytics()->setTrackingId('G-XT6R37X62E');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/codes/ga4/basic.html'),
            $script->render()
        );
    }

    /**
     * @return AnalyticsFour
     */
    protected function initScript()
    {
        $ga = new \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics();

        $script = new AnalyticsFour();
        $script->setGoogleAnalytics($ga);
        return $script;
    }
}
