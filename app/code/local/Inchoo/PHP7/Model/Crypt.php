<?php

/**
 * Crypt factory
 */
class Inchoo_PHP7_Model_Crypt
{
    /**
     * Factory method to return requested cipher logic
     *
     * @param string $method
     * @return Varien_Crypt_Abstract
     * @throws Varien_Exception
     */
    static public function factory($method = 'auto')
    {
        if($method == 'mcrypt' || ($method == 'auto' && function_exists('mcrypt_module_open'))) {
            $crypt = new Varien_Crypt_Mcrypt();
        } elseif ($method == 'openssl' || ($method == 'auto' && extension_loaded('openssl'))) {
            $crypt = new Inchoo_PHP7_Model_Crypt_Openssl();
        } else {
            throw new Varien_Exception('Crypt adapter not available.');
        }

        return $crypt;
    }
}
