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
use SimpleTemplate\Text;
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
        $regExp = '/^' . '\\' . implode('\\', str_split(self::OPEN_TAG)) . '\s+([^\s\\'.self::CHAIN_SEPARATOR.']+)(\\'.self::CHAIN_SEPARATOR.'(.*))?\s+' . '\\' . implode('\\', str_split(self::CLOSE_TAG)) .'$/';
        Log\logging("Try use '$regExp' to '$strChunk'", "trace");
        if (0 < preg_match($regExp, $strChunk, $matches) ) {
            $text = trim($matches[1]);
            $filters = isset($matches[3]) ? $matches[3] : "";
            if ("" == $filters) {
                $textFactory = new Text\Chunk();
                return $textFactory->create($text);
            }
            $filters = explode(self::CHAIN_SEPARATOR, $filters);
            $filterList = array();
            foreach ($filters as $filterAlias) {
                $filterName = "SimpleTemplate\\Filters\\" . ucfirst($filterAlias) . "Filter";
                if (class_exists($filterName)) {
                    Log\logging("Such class exists", "trace");
                    $filterList[] = new $filterName();
                } else {
                    // Tests support
                    Log\logging("Such doesn't class exists", "error");
                    $filterList[] = $filterAlias;
                }
            }
            return array(
                "type"    => self::CHUNK_NAME,
                "text"    => $text,
                "filters" => $filterList,
            );
        }
        $textFactory = new Text\Chunk();
        return $textFactory->create($strChunk);
    }

    /**
     * Check global requirements for data
     *
     * @param $realString String data for parsing
     * @return boolean
     */
    public function isParsable($realString) {
        $result = substr_count($realString, self::OPEN_TAG) == substr_count($realString, self::CLOSE_TAG);
        Log\logging(__METHOD__, "trace");
        Log\logging("Open tags: " . substr_count($realString, self::OPEN_TAG), "trace");
        Log\logging("Close tags: " . substr_count($realString, self::CLOSE_TAG), "trace");
        return $result;
    }


}