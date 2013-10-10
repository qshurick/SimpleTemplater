<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 14:49
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

class Parser {

    protected $_realData;
    protected $_chunks = array();

    private $valid = null;

    /**
     * @param $data String text for parsing
     */
    public function setData($data) {
        $this->_realData = $data;
    }

    private function _validate() {
        $startTag = "{{";
        $endTag   = "}}";
        try {
            // check all tags are closed
            \PHPUnit_Framework_Assert::assertEquals(
                substr_count($this->_realData, $startTag),
                substr_count($this->_realData, $endTag)
            );

        } catch (\PHPUnit_Framework_ExpectationFailedException $ex) {
            return false;
        }
        return true;
    }

    public function isValid() {
        if (is_null($this->valid)) {
            $this->valid = $this->_validate();
        }
        return $this->valid;
    }

    public function reValidate() {
        $this->valid = null;
        $this->isValid();
    }

    private function _chunk() {
        $startTag = "{{";
        $endTag   = "}}";
        $prepare = $this->_realData;
        $prepare = str_replace($startTag, "\n" . $startTag, $prepare);
        $prepare = str_replace($endTag, $endTag . "\n", $prepare);
        $prepare = preg_replace("/\n+/", "\n", $prepare);
        $prepare = explode("\n", $prepare);

        $chunks = array();
        foreach($prepare as $item) {
            $tmp = $this->_createChunk($item);
            if ("" == $tmp["text"] && "simple-text" == $tmp["type"]) continue;
            $chunks[] = $tmp;
        }
        return $chunks;
    }

    private function _createChunk($item) {
        $startTag = "{{";
        $endTag   = "}}";
        $item = trim($item);
        $chunk = array();
        if (false !== strpos($item, $startTag)) {
            $tmp = preg_replace('/' . $startTag . '\s+(.*)\s+' . $endTag .'/', "$1", $item);
            if (false !== strpos($tmp, "|")) {
                list($text, $filters) = explode("|", $tmp, 2);
                $filters = explode("|", $filters);
                $chunk = array(
                    "type" => "filter",
                    "text" => $text,
                    "filters" => $filters
                );
            } else {
                // not a filter
                $text = $tmp;
                $chunk = array(
                    "type" => "simple-text",
                    "text" => $text
                );
            }
        } else {
            $chunk = array(
                "type" => "simple-text",
                "text" => $item,
            );
        }
        return $chunk;
    }

    public function getChunks() {
        if ($this->isValid()) {
            $this->_chunks = $this->_chunk();
        }
        return $this->_chunks;
    }

}