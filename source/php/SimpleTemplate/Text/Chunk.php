<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 17:50
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Text;

class Chunk implements \SimpleTemplate\Chunk {

    const CHUNK_NAME = "simple-text";

    /**
     * Create Chunk if $strChunk is valid or throw an Exception
     *
     * @param $strChunk
     * @return Chunk
     */
    public function create($strChunk) {
        return array(
            "type" => self::CHUNK_NAME,
            "text" => $strChunk
        );
    }

    /**
     * Check text for chunks present and set $separator around chunk
     *
     * @param $realString String data for parsing
     * @param $separator  String separator value
     * @return String prepared string
     */
    public function prepare($realString, $separator) {
        return $realString;
    }

    /**
     * Check if given $strChunk is a current chunk item
     *
     * @param $strChunk
     * @return boolean
     */
    public function valid($strChunk) {
        return true;
    }

    /**
     * Check global requirements for data
     *
     * @param $realString String data for parsing
     * @return boolean
     */
    public function isParsable($realString) {
        return true;
    }


}