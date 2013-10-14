<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 14.10.13
 * Time: 11:28
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

/**
 * Class Token used to describe element os the parsed data
 */
abstract class Token {
    const UNDEFINED = "undefined";

    protected $_originalString;

    /**
     * @param null|array $env environment description
     * @return string code for displaying
     */
    public function getData($env = null) {
        return "";
    }

    public function getType() {
        return self::UNDEFINED;
    }
}