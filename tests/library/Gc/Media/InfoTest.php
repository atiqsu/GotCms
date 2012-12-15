<?php
namespace Gc\Media;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class InfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Info
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers Gc\Media\Info::init
     */
    protected function setUp()
    {
        $this->_object = new Info;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Gc\Media\Info::fromFile
     */
    public function testFromFile()
    {
        $file_path = __DIR__ . '/_files/information.info';
        $this->assertTrue($this->_object->fromFile($file_path));
        $this->assertTrue($this->_object->fromFile($file_path));
    }

    /**
     * @covers Gc\Media\Info::fromFile
     */
    public function testFromFileWithWrongFilePath()
    {
        $this->assertFalse($this->_object->fromFile('wrong-path-file.info'));
    }

    /**
     * @covers Gc\Media\Info::render
     */
    public function testRender()
    {
        $file_path = __DIR__ . '/_files/information.info';
        $this->_object->fromFile($file_path);
        $assert_string = '<dl><dt>Author</dt><dd>Pierre Rambaud</dd><dt>Date</dt><dd>2012</dd><dt>Version</dt><dd>0.1</dd><dt>Description</dt><dd>Information test</dd><dt>Database compatibility</dt><dd>pgsql</dd><dt>Website url</dt><dd><a href="http://rambaudpierre.fr">website</a></dd></dl>';
        $this->assertEquals($assert_string, $this->_object->render());
    }

    /**
     * @covers Gc\Media\Info::render
     */
    public function testRenderWithWrongFilePath()
    {
        $this->_object->fromFile('wrong-path-file.info');
        $this->assertFalse($this->_object->render());
    }
}
