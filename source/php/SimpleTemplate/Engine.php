<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 09.10.13
 * Time: 17:12
 * To change this template use File | Settings | File Templates.
 */


namespace SimpleTemplate;

require_once 'ext/common/common.inc.php';

use SimpleTemplate\Filters;

class Engine {

    /**
     * @var array list of default filters
     */
    protected $_postFilters = array();

    protected $_value;

    public function init() {
        array_push($this->_postFilters, new Filters\TrimSpacesFilter());
    }

    private function postFilters() {
        foreach ($this->_postFilters as $filter) {
            $this->_value = $filter->filter($this->_value);
        }
    }

    public function parse($text) {
        $this->_value = $text;
        $this->postFilters();
        return '<p>' . $this->_value . '</p>';
    }
}