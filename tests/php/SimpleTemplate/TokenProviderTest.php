<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 18:09
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

use SimpleTemplate;

class TokenProviderTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \SimpleTemplate\TokenParser
     */
    protected $_parser;

    public function setUp() {
        $list = new \SimpleTemplate\TokenList();

        /*$mockToken = $this->getMock('\SimpleTemplate\Token', array('getType', 'getData'));
        $mockToken->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('test'))
            ->method('getData')
            ->will($this->returnValue("hello, world"));

        $list->add($mockToken);*/

        $this->_parser = new \SimpleTemplate\TokenParser($list);
    }

    public function testProviderMakesGoodTokens() {
        $mockToken = $this->getMock('\SimpleTemplate\Token', array('getType', 'getData'));
        $mockToken->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('test'))
            ->method('getData')
            ->will($this->returnValue("hello, world"));

        $mockProvider = $this->getMock('\SimpleTemplate\TokenProvider', array('process'));
        $mockProvider->expects($this->any())
            ->method('process')
            ->will($this->returnValue($mockToken));


    }

}