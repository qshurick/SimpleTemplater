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
    protected $_preparedData = array();

    public function addPostFilter($filter) {
        if (!$filter instanceof Filters\Filter) {
            throw new Filters\Exceptions\NotImplementedFilterInterfaceException();
        }
        array_push($this->_postFilters, $filter);
    }

    private function postFilters() {
        foreach ($this->_postFilters as $filter) {
            /** @var $filter Filters\Filter */
            $this->_value = $filter->filter($this->_value);
        }
    }

    public function parse($text) {
        $this->_value = $text;
        $this->postFilters();
        return '<p>' . $this->_value . '</p>';
    }
}