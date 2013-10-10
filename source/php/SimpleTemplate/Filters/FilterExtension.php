<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate\Filters;

interface FilterExtension {
    /**
     * Setter for extra filter arguments,
     *  that could e given through the template
     * @param array $args array of the extra arguments
     */
    public function setArguments($args = array());
}