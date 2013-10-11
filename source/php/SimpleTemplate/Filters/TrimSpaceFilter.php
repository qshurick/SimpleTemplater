<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 11:05
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Filters;

class TrimSpaceFilter implements Filter {

    /**
     * Filter change incoming string according to internal rules
     *  filters can be used in chains
     * @param  $str  String incoming string
     * @return mixed String filtered string
     */
    public function filter($str) {
        $str = preg_replace('/\n/', ' ', $str);
        $str = preg_replace('/\s+/', ' ', $str);
        return trim($str);
    }

    /**
     * Setter for extra filter arguments,
     *  that could e given through the template
     * @param array $args array of the extra arguments
     */
    public function setArguments($args = array()) {}

    /**
     * @return String filter alias, see: {{ some phrase|filterAlias }}
     */
    public function getAlias() {
        return "trim";
    }


}