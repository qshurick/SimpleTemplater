<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 11:31
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

class LinkedList {
    protected $_list;
    protected $_count;
    protected $_currentIndex;
    protected $_done = false;

    /** @var \SimpleTemplate\LinkedListItem */
    protected $_first;
    /** @var \SimpleTemplate\LinkedListItem */
    protected $_last;
    /** @var \SimpleTemplate\LinkedListItem */
    protected $_current;

    public function __construct() {
        $this->_list  = array();
        $this->_count = 0;
        $this->_currentIndex = null;

        $this->_current = null;
        $this->_last = null;
        $this->_first = null;
    }

    public function isEmpty() {
        return true;
    }

    public function add($item) {
        $newItem = new \SimpleTemplate\LinkedListItem($item, $this->_last, null);
        if (null !== $this->_last) {
            $this->_last->setNext($newItem);
        }
        if (null === $this->_first) {
            $this->_first = $newItem;
        }
        $this->_last = $newItem;
        $this->_count++;
    }

    public function count() {
        return $this->_count;
    }

    public function next() {
        if (null === $this->_current && !$this->_done) {
            $this->_current = $this->_first;
        } else {
            $this->_current = $this->_current->next();
        }
        if (null === $this->_current) {
            $this->_done = true;
            throw new \SimpleTemplate\Exceptions\LinkedListIsOverException();
        }
        \SimpleTemplate\logging($this->_current->toString());
        return $this->_current->getValue();
    }

    public function hasNext() {
        if ($this->_done) {
            return false;
        }
        if (null == $this->_current) {
            return 0 < $this->_count;
        }
        return $this->_current->hasNext();
    }

    public function current() {
        if (null === $this->_current) {
            throw new \SimpleTemplate\Exceptions\LinkedListNoPointerException();
        }
        return $this->_current->getValue();
    }

    public function reset() {
        $this->_current = null;
        $this->_done = false;
    }

}