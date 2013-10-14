<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 12:10
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

class LinkedListItem {

    protected $_value;
    /** @var \SimpleTemplate\LinkedListItem */
    protected $_previous;
    /** @var \SimpleTemplate\LinkedListItem */
    protected $_next;

    public function __construct($value, $previous = null, $next = null) {
        $this->_value    = $value;
        $this->_previous = $previous;
        $this->_next     = $next;
    }

    public function getValue() {
        return $this->_value;
    }

    public function hasNext() {
        return null !== $this->_next;
    }

    /**
     * @return \SimpleTemplate\LinkedLIstItem
     */
    public function next() {
        return $this->_next;
    }

    public function previous() {
        return $this->_previous;
    }

    /**
     * @param $previous null|\SimpleTemplate\LinkedListItem
     */
    public function setPrevious($previous) {
        $this->_previous = $previous;
    }

    /**
     * @param $next null|\SimpleTemplate\LinkedListItem
     */
    public function setNext($next) {
        $this->_next = $next;
    }

    public function makeChain(\SimpleTemplate\LinkedList $chain) {
        $chain->getFirst()->setPrevious($this->_previous);
        if (null !== $this->_previous) $this->_previous->setNext($chain->getFirst());
        $chain->getLast()->setNext($this->_next);
        if (null !== $this->_next) $this->_next->setPrevious($chain->getLast());

        $this->_next     = null;
        $this->_previous = null;
        $this->_value    = null;
    }

    public function toString() {
        $result  = (null === $this->_previous) ? " null >> " : $this->_previous->getValue() . " >> ";
        $result .= $this->getValue();
        $result .= (null === $this->_next) ? " << null" : " << " . $this->_next->getValue();
        return $result . "\n";
    }

}