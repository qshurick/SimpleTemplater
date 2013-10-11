<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 17:41
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Filters;

require_once 'ext/common/common.inc.php';

use SimpleTemplate\Filters\Exceptions;
use SimpleTemplate as Log;

class Chunk implements \SimpleTemplate\Chunk {

    const OPEN_TAG  = '{{';
    const CLOSE_TAG = '}}';
    const CHAIN_SEPARATOR = "|";
    const CHUNK_NAME = "filter";

    /**
     * Check text for chunks present and set $separator around chunk
     *
     * @param $realString String data for parsing
     * @param $separator  String separator value
     * @return String prepared string
     */
    public function prepare($realString, $separator) {
        $realString = str_replace(self::OPEN_TAG, $separator . self::OPEN_TAG, $realString);
        $realString = str_replace(self::CLOSE_TAG, self::CLOSE_TAG . $separator, $realString);
        return $realString;
    }

    /**
     * Check if given $strChunk is a current chunk item
     *
     * @param $strChunk
     * @return boolean
     */
    public function valid($strChunk) {
        return 0 < preg_match('/^' . self::OPEN_TAG . '.*' . self::CHAIN_SEPARATOR . '.*' . self::CLOSE_TAG .'$/', $strChunk);
    }

    /**
     * Create Chunk if $strChunk is valid or throw an Exception
     *
     * @param $strChunk
     * @return Chunk
     */
    public function create($strChunk) {
        if (0 < preg_match('/^' . self::OPEN_TAG . '\s+([^\s'.self::CHAIN_SEPARATOR.'])'.self::CHAIN_SEPARATOR.'(.*)\s+' . self::CLOSE_TAG .'$/', $strChunk, $matches) ) {
            $text = trim($matches[1]);
            $filters = trim($matches[2]);
            if ("" == $filters) {
                throw new Exceptions\InvalidFilterChunkStringException("Filter name not found");
            }
            $filters = explode(self::CHAIN_SEPARATOR, $filters);
            return array(
                "type"    => self::CHUNK_NAME,
                "text"    => $text,
                "filters" => $filters,
            );
        }
        throw new Exceptions\InvalidFilterChunkStringException();
    }

    /**
     * Check global requirements for data
     *
     * @param $realString String data for parsing
     * @return boolean
     */
    public function isParsable($realString) {
        $result = substr_count($realString, self::OPEN_TAG) == substr_count($realString, self::CLOSE_TAG);
        Log\logging(__METHOD__);
        Log\logging("Open tags: " . substr_count($realString, self::OPEN_TAG), "debug");
        Log\logging("Close tags: " . substr_count($realString, self::CLOSE_TAG), "debug");
        return $result;
    }


}