<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 14:52
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

class TokenList extends \SimpleTemplate\LinkedList {

    protected $_hasUndefined;

    protected function _calculateUndefinedTokens() {
        $tmpCurrent = $this->_current;
        $tmpDone    = $this->_done;

        $this->_current = null;
        $this->_done = false;
        while($this->hasNext()) {
            /** @var $value \SimpleTemplate\Token */
            $value = $this->next();
            if (\SimpleTemplate\Token::UNDEFINED === $value->getType()) {
                $this->_current = $tmpCurrent;
                $this->_done = $tmpDone;
                $this->_hasUndefined = true;
                return true;
            }
        }
        $this->_current = $tmpCurrent;
        $this->_done = $tmpDone;
        $this->_hasUndefined = false;
        return false;
    }

    public function hasUndefined() {
        return $this->_hasUndefined;
    }

    /**
     * @param $item \SimpleTemplate\Token
     */
    public function add($item) {
        if ($item instanceof \SimpleTemplate\Token) {
            parent::add($item);
            $this->_calculateUndefinedTokens();
            return $this;
        }
        throw new \Exception('Only \SimpleTemplate\Token are supported');
    }

    /**
     * @param \SimpleTemplate\TokenList $chain
     */
    public function makeChain(\SimpleTemplate\LinkedList $chain) {
        if ($chain instanceof \SimpleTemplate\TokenList) {
            parent::makeChain($chain);
            $this->_calculateUndefinedTokens();
            return $this;
        }
        throw new \Exception('Only \SimpleTemplate\TokenList are supported');
    }


}