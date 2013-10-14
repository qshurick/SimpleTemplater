<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 16:01
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

use SimpleTemplate;

class TokenListTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var \SimpleTemplate\TokenList
     */
    protected $_list;
    public function setUp() {
        $this->_list = new \SimpleTemplate\TokenList();
    }
    public function testIfRightHierarchy() {
        $this->assertTrue($this->_list instanceof \SimpleTemplate\LinkedList);
    }

    public function testCalculatingUndefined() {
        $mockUndefined = $this->getMock('\SimpleTemplate\Token', array("getType"));
        $mockUndefined->expects($this->any())
            ->method("getType")
            ->will($this->returnValue(\SimpleTemplate\Token::UNDEFINED));
        $this->_list->add($mockUndefined);
        $this->assertTrue($this->_list->hasUndefined());
    }

    public function testCalculatingUndefinedWithoutThem() {
        $mockUndefined = $this->getMock('\SimpleTemplate\Token', array("getType"));
        $mockUndefined->expects($this->any())
            ->method("getType")
            ->will($this->returnValue("I'm not an " . \SimpleTemplate\Token::UNDEFINED));
        $this->_list->add($mockUndefined);
        $this->assertFalse($this->_list->hasUndefined());
    }
}