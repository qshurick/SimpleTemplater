<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 17:42
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

interface Chunk {

    /**
     * Check text for chunks present and set $separator around chunk
     *
     * @param $realString String data for parsing
     * @param $separator  String separator value
     * @return String prepared string
     */
    public function prepare($realString, $separator);

    /**
     * Check global requirements for data
     *
     * @param $realString String data for parsing
     * @return boolean
     */
    public function isParsable($realString);

    /**
     * Check if given $strChunk is a current chunk item
     *
     * @param $strChunk
     * @return boolean
     */
    public function valid($strChunk);

    /**
     * Create Chunk if $strChunk is valid or throw an Exception
     *
     * @param $strChunk
     * @return Chunk
     */
    public function create($strChunk);

}