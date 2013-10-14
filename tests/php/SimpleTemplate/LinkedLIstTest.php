<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

namespace Test;

use SimpleTemplate;

class LinkedListTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var SimpleTemplate\LinkedLIst
     */
    protected $_list;
    public function setUp() {
        $this->_list = new SimpleTemplate\LinkedList();
    }

    public function testEmptyList() {
        $this->assertTrue($this->_list->isEmpty());
    }

    public function testCounting() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->assertEquals(2, $this->_list->count());
    }

    public function testNextSimple() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->assertEquals(1, $this->_list->next());
        $this->assertEquals(2, $this->_list->next());
    }

    /**
     * @expectedException SimpleTemplate\Exceptions\LinkedListIsOverException
     */
    public function testRightExceptionInTheEnd() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->_list->next(); // ok
        $this->_list->next(); // ok
        $this->_list->next(); // LinkedListIsOverException
    }

    public function testHasNextIsWorks() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->assertTrue($this->_list->hasNext());
        $this->_list->next(); // ok
        $this->assertTrue($this->_list->hasNext());
        $this->_list->next(); // ok
        $this->assertFalse($this->_list->hasNext());
    }

    public function testCurrent() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->_list->next(); // ok
        $this->assertEquals(1, $this->_list->current());
        $this->_list->next(); // ok
        $this->assertEquals(2, $this->_list->current());
    }

    /**
     * @expectedException SimpleTemplate\Exceptions\LinkedListNoPointerException
    */
    public function testCurrentIsUnavailableFirst(){
        $this->_list->current();
    }

    public function testResetLooping() {
        $this->_list->add(1);
        $this->_list->add(2);
        $this->_list->next();
        $this->_list->next();
        $this->_list->reset();
        $this->_list->next();
        $this->_list->next();
    }

    public function testHasNextOnFirstItem() {
        $this->_list->add(1);
        $this->assertTrue($this->_list->hasNext());
    }

}