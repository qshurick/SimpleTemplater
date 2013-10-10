<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 09.10.13
 * Time: 17:12
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Filters;

interface Filter {

    /**
     * Filter change incoming string according to internal rules
     *  filters can be used in chains
     * @param  $str  String incoming string
     * @return mixed String filtered string
     */
    public function filter($str);

    /**
     * Setter for extra filter arguments,
     *  that could e given through the template
     * @param array $args array of the extra arguments
     */
    public function setArguments($args = array());
}