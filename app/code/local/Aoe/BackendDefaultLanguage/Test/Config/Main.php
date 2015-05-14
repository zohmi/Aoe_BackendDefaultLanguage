<?php

/**
 * Class Aoe_BackendDefaultLanguage_Test_Config_Main
 *
 * @category Test
 * @package  Aoe_BackendDefaultLanguage
 * @author   Daniel Zohm <daniel.zohm@aoe.com>
 * @license  GNU General Public License (GPLv3)
 * @link     https://github.com/zohmi/Aoe_BackendDefaultLanguage
 */
class Aoe_BackendDefaultLanguage_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     * @return void
     */
    public function testCodePool()
    {
        $this->assertModuleCodePool('local');
    }

    /**
     * @test
     * @return void
     */
    public function testModuleVersion()
    {
        $this->assertModuleVersionGreaterThanOrEquals('0.0.1');
    }
}
