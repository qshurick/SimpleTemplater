<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 18:02
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

class TokenParser {

    /**
     * @var \SimpleTemplate\TokenList
    */
    protected $_tokens;
    protected $_tokenProviderList;

    public function __construct(\SimpleTemplate\TokenList $tokens) {
        $this->_tokens = $tokens;
    }

    public function parseWith(\SimpleTemplate\TokenProvider $provider) {
        foreach($this->_tokens as $token) {

        }
    }

}