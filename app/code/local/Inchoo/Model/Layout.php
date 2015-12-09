<?php
/**
 * Created on: 07.12.15.
 * @copyright Inchoo d.o.o. (http://inchoo.net)
 * @author Ivan Čurdinjaković
 * @license MIT
 */ 
class Inchoo_PHP7_Model_Layout extends Mage_Core_Model_Layout
{
    public function getOutput()
    {
        $out = '';
        if (!empty($this->_output)) {
            foreach ($this->_output as $callback) {
                $out .= $this->getBlock($callback[0])->{$callback[1]}();
            }
        }

        return $out;
    }
}