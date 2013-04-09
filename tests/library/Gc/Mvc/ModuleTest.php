<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\Mvc;

use Gc\Registry;
use Gc\Core\Config;
use Gc\Layout\Model as LayoutModel;
use Gc\View\Stream;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Module
     *
     * @return void
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        include_once __DIR__ . '/ModuleUnit.php';
        $this->object = new ModuleUnit;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Test
     *
     * @covers Gc\Mvc\Module::onBootstrap
     *
     * @return void
     */
    public function testOnBootstrap()
    {
        Registry::getInstance()->offsetUnset('Translator');
        $uri = Registry::get('Application')->getRequest()->getUri();
        $uri->setHost('got-cms.com');
        $uri->setPort(443);
        $this->assertNull($this->object->onBootstrap(Registry::get('Application')->getMvcEvent()));
    }

    /**
     * Test
     *
     * @covers Gc\Mvc\Module::prepareException
     *
     * @return void
     */
    public function testPrepareException()
    {
        Stream::register();
        $layout_model = LayoutModel::fromArray(
            array(
                'name' => 'Layout Name',
                'identifier' => 'Layout identifier',
                'description' => 'Layout Description',
                'content' => 'Layout Content'
            )
        );

        $layout_model->save();
        Config::setValue('site_exception_layout', $layout_model->getId());
        $this->assertNull($this->object->prepareException(Registry::get('Application')->getMvcEvent()));
        $layout_model->delete();
    }

    /**
     * Test
     *
     * @covers Gc\Mvc\Module::getAutoloaderConfig
     * @covers Gc\Mvc\Module::getDir
     * @covers Gc\Mvc\Module::getNamespace
     *
     * @return void
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', $this->object->getAutoloaderConfig());
    }

    /**
     * Test
     *
     * @covers Gc\Mvc\Module::getConfig
     *
     * @return void
     */
    public function testGetConfig()
    {
        Config::setValue('debug_is_active', 1);
        $this->assertInternalType('array', $this->object->getConfig());
    }

    /**
     * Test
     *
     * @covers Gc\Mvc\Module::init
     *
     * @return void
     */
    public function testInit()
    {
        $old_database      = Registry::get('Db');
        $old_configuration = Registry::get('Configuration');
        $old_adapter       = GlobalAdapterFeature::getStaticAdapter();

        if (!Config::getValue('session_lifetime')) {
            Config::getInstance()->insert(
                array(
                    'identifier' => 'session_lifetime',
                    'value'      => 3600,
                )
            );
        }

        if (!Config::getValue('session_lifetime')) {
            Config::getInstance()->insert(
                array(
                    'identifier' => 'cookie_domain',
                    'value'      => 'got-cms.com',
                )
            );
        }

        Config::setValue('session_handler', Config::SESSION_DATABASE);

        Registry::getInstance()->offsetUnset('Configuration');
        $this->assertNull($this->object->init(Registry::get('Application')->getServiceManager()->get('ModuleManager')));

        Registry::set('Db', $old_database);
        Registry::set('Configuration', $old_configuration);
        GlobalAdapterFeature::setStaticAdapter($old_adapter);
    }
}
