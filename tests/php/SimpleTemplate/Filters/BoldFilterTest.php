<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 12:22
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Filter;

require_once 'ext/common/common.inc.php';

use SimpleTemplate\Filters;

class BoldFilterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Filters\BoldFilter
     */
    protected $_filter;

    public function setUp() {
        $this->_filter = new Filters\BoldFilter();
    }

    public function testSimpleTextBold() {
        $text = "make me bold";
        $filtered = "<" . Filters\BoldFilter::TAG . ">make me bold</" . Filters\BoldFilter::TAG . ">";
        $this->assertEquals($filtered, $this->_filter->filter($text));
    }

}