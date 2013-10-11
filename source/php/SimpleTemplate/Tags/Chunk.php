<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 11.10.13
 * Time: 17:23
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Tags;

class Chunk implements \SimpleTemplate\Chunk {

    const TAG = "{% break %}";

    /**
     * Check global requirements for data
     *
     * @param $realString String data for parsing
     * @return boolean
     */
    public function isParsable($realString) {
        return true;
    }

    /**
     * Check if given $strChunk is a current chunk item
     *
     * @param $strChunk
     * @return boolean
     */
    public function valid($strChunk) {
        return self::TAG == $strChunk;
    }

    /**
     * Check text for chunks present and set $separator around chunk
     *
     * @param $realString String data for parsing
     * @param $separator  String separator value
     * @return String prepared string
     */
    public function prepare($realString, $separator) {
        return str_replace(self::TAG, $separator . self::TAG . $separator, $realString);
    }

    /**
     * Create Chunk if $strChunk is valid or throw an Exception
     *
     * @param $strChunk
     * @return Chunk
     */
    public function create($strChunk) {
        $text = new \SimpleTemplate\Text\Chunk();
        return $text->create('</p><p>');
    }


}