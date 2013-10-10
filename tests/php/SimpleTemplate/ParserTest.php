<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 14:50
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

require_once 'ext/common/common.inc.php';

use SimpleTemplate;

class ParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SimpleTemplate\Parser
     */
    protected $_parser;

    public function setUp() {
        $this->_parser = new SimpleTemplate\Parser();
    }

    /**
     * @dataProvider simpleTokensDataProvider
     */
    public function testSimpleTokens($source, $parsed) {
        /*$source = "Hello, world!";
        $parsed = array(
            array(
                "text" => "Hello, world!",
                "type" => "simple-text"
            )
        );*/
        $this->_parser->setData($source);
        $this->assertEquals($parsed, $this->_parser->getChunks());
    }

    public function simpleTokensDataProvider() {
        return array(
            array("Hello, world!", array(
                array(
                    "type" => "simple-text",
                    "text" => "Hello, world!",
                ),
            )),
            array("{{ Hello }}, world!", array(
                array(
                    "text" => "Hello",
                    "type" => "simple-text",
                ),
                array(
                    "text" => ", world!",
                    "type" => "simple-text",
                ),
            )),
            array("Hello, {{ world|filter }}!", array(
                array (
                    "text" => "Hello,",
                    "type" => "simple-text",
                ),
                array (
                    "text" => "world",
                    "type" => "filter",
                    "filters" => array("filter", ),
                ),
                array (
                    "text" => "!",
                    "type" => "simple-text",
                ),
            )),
        );
    }

    /**
     * @dataProvider validationPassDataProvider
     * @param $source String tests set
     */
    public function testValidationPass($source) {
        $this->_parser->setData($source);
        $this->assertTrue($this->_parser->isValid());

    }

    public function validationPassDataProvider(){
        return array(
            array("Hello, world!"),
            array("Hello, {{ world }}!"),
            array("{{ Hello }}, {{ world }}!"),
        );
    }

    /**
     * @dataProvider validationFailDataProvider
     * @param $source String tests set
     */
    public function testValidationFail($source) {
        $this->_parser->setData($source);
        $this->assertFalse($this->_parser->isValid());

    }

    public function validationFailDataProvider(){
        return array(
            array("Hello, world }} !"),
            array("Hello, {{ world }}! {{ "),
            array("{{ Hello }}, {{ world }}}}!"),
        );
    }

}