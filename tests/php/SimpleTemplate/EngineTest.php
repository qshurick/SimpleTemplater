<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 09.10.13
 * Time: 17:16
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

require_once 'ext/common/common.inc.php';

use SimpleTemplate;

class EngineTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var null|SimpleTemplate\Engine
     */
    protected $engine = null;

    public function setUp() {
        $this->engine = new SimpleTemplate\Engine();
        $this->engine->init();
    }

    public function testEnginePresent() {
        $this->assertNotNull($this->engine);
    }

    public function testOneParagraph() {
        $text = "Hello, world!";
        $html = "<p>Hello, world!</p>";
        $this->assertEquals($html, $this->engine->parse($text));
    }

    public function testTrimSpaces() {
        $text = "  Hello,   world! ";
        $html = "<p>Hello, world!</p>";
        $this->assertEquals($html, $this->engine->parse($text));
    }

    public function testTrimBreaks() {
        $text = "
        Hello,
        world!
        ";
        $html = "<p>Hello, world!</p>";
        $this->assertEquals($html, $this->engine->parse($text));
    }

}