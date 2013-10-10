<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 11:11
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Filter;

require_once 'ext/common/common.inc.php';

use SimpleTemplate\Filters;

class TrimSpaceFilter extends \PHPUnit_Framework_TestCase {

    /**
     * @var Filters\TrimSpaceFilter
     */
    protected $filter;

    public function setUp() {
        $this->filter = new Filters\TrimSpaceFilter();
    }

    public function testTrimBeforeSpaces() {
        $text     = "       some text";
        $filtered = "some text";
        $this->assertEquals($filtered, $this->filter->filter($text));
    }

    public function testTrimAfterSpaces() {
        $text     = "some text       ";
        $filtered = "some text";
        $this->assertEquals($filtered, $this->filter->filter($text));
    }

    public function testTrimInternalSpaces() {
        $text     = "some    test and    text";
        $filtered = "some test and text";
        $this->assertEquals($filtered, $this->filter->filter($text));
    }

    public function testTrimBreaks() {
        $text     = "some
        test
        and
        text";
        $filtered = "some test and text";
        $this->assertEquals($filtered, $this->filter->filter($text));
    }

}