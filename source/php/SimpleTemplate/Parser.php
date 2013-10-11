<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 14:49
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

use SimpleTemplate\Filters\Exceptions\InvalidFilterChunkStringException;

class Parser {

    protected $_realData;
    protected $_preparedData;
    protected $_chunks = array();
    protected $_chuckFactories = array();

    private $valid = null;

    public function addChunkFactory($factory) {
        if ($factory instanceof Chunk) {
            array_push($this->_chuckFactories, $factory);
        }
    }

    /**
     * @param $data String text for parsing
     */
    public function setData($data) {
        $this->_realData = $data;
    }

    private function _validate() {
        $data = $this->_realData;
        foreach($this->_chuckFactories as $factory) {
            /** @var $factory Chunk */
            if (!$factory->isParsable($data)) return false;
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

    private function _prepare() {
        $prepare = $this->_realData;
        foreach ($this->_chuckFactories as $factory) {
            /** @var $factory Chunk */
            $prepare = $factory->prepare($prepare, "\n");
        }
        $this->_preparedData = $prepare;
    }

    private function _chunk() {
        $this->_prepare();
        $chunks = array();
        $prepared = explode("\n", $this->_preparedData);
        foreach($prepared as $chunk) {
            if ("" == $chunk) continue;
            foreach($this->_chuckFactories as $factory) {
                /** @var $factory Chunk */
                if ($factory->valid($chunk)) {
                    try {
                        $chunks[] = $factory->create($chunk);
                        break;
                    } catch (InvalidFilterChunkStringException $ex) {
                        continue;
                    }
                }
            }
        }
        return $chunks;
    }

    public function getChunks() {
        if ($this->isValid()) {
            $this->_chunks = $this->_chunk();
        }
        return $this->_chunks;
    }

}