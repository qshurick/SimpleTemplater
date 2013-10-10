<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 12:21
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Filters;

class BoldFilter implements Filter {

    const TAG = 'strong';

    /**
     * Filter change incoming string according to internal rules
     *  filters can be used in chains
     * @param  $str  String incoming string
     * @return mixed String filtered string
     */
    public function filter($str) {
        return "<" . self::TAG . ">$str</" . self::TAG . ">";
    }

    /**
     * Setter for extra filter arguments,
     *  that could e given through the template
     * @param array $args array of the extra arguments
     */
    public function setArguments($args = array()) {}


}