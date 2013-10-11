<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 11.10.13
 * Time: 17:12
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

require_once 'ext/common/common.inc.php';

use SimpleTemplate;

class ParseWithTagsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SimpleTemplate\Parser
     */
    protected $_parser;

    public function setUp() {
        $this->_parser = new SimpleTemplate\Parser();
        $this->_parser->addChunkFactory(new SimpleTemplate\Tags\Chunk());
        $this->_parser->addChunkFactory(new SimpleTemplate\Text\Chunk());
    }

    public function testSimpleParseWithBreak() {
        $string = "Hello, world! {% break %} I did it =)";
        $html   = "<p>Hello, world! </p><p>I did it =)</p>";
        $this->_parser->setData($string);
        $chunks = $this->_parser->getChunks();
        $this->assertEquals($html, $this->_parser->parse($chunks));
    }

}