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

namespace Gc\Core;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Config
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_object = new Config;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->_object);
    }

    /**
     * @covers Gc\Core\Config::getInstance
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf('Gc\Core\Config', Config::getInstance());
    }

    /**
     * @covers Gc\Core\Config::getValue
     */
    public function testGetValue()
    {
        $this->_object->insert(array('identifier' => 'string_test', 'value' => 'string_result'));
        $this->assertEquals('string_result', $this->_object->getValue('string_test'));
        $this->_object->delete(array('identifier' => 'string_test'));
    }

    /**
     * @covers Gc\Core\Config::getValue
     */
    public function testGetValueWithEmptyIdentifier()
    {
        $this->assertNull($this->_object->getValue(''));
    }

    /**
     * @covers Gc\Core\Config::getValues
     */
    public function testGetValues()
    {
        $this->assertInternalType('array', $this->_object->getValues());
    }
    /**
     * @covers Gc\Core\Config::getValues
     */
    public function testGetEmptyValues()
    {
        $values = $this->_object->getValues();
        $this->_object->delete('1 = 1');
        $this->assertNull($this->_object->getValues());

        //restore data
        foreach($values as $value)
        {
            $this->_object->insert($value);
        }
    }

    /**
     * @covers Gc\Core\Config::setValue
     */
    public function testSetValueWithFakeIdentifier()
    {
        $this->assertFalse($this->_object->setValue('fake_identifier', 'fake_value'));
    }

    /**
     * @covers Gc\Core\Config::setValue
     */
    public function testSetValue()
    {
        $this->_object->insert(array('identifier' => 'string_identifier', 'value' => 'string_result_insert_value'));
        $this->assertTrue((bool)$this->_object->setValue('string_identifier', 'string_result_insert_value'));
        $this->_object->delete(array('identifier' => 'string_identifier'));
    }

    /**
     * @covers Gc\Core\Config::setValue
     */
    public function testSetValueWithEmptyIdentifier()
    {
        $this->assertFalse($this->_object->setValue('', 'string_result_insert_value'));
    }
}
