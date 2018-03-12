<?php

if (Mage::getConfig()->getModuleConfig('Amasty_Orderattr')->is('active', 'true')) {
    class Inchoo_PHP7_Helper_Data_Abstract extends Amasty_Orderattr_Helper_Core_Data {}
} else {
    class Inchoo_PHP7_Helper_Data_Abstract extends Mage_Core_Helper_Data {}
}

class Inchoo_PHP7_Helper_Data extends Inchoo_PHP7_Helper_Data_Abstract
{
    /** @var string $_moduleName Compatibility for translations, and maybe other stuff which uses module names. */
    protected $_moduleName = 'Mage_Core';

    /**
     * Decodes the given $encodedValue string which is encoded in the JSON format
     *
     * Overridden to prevent exceptions in json_decode
     *
     * @param string $encodedValue
     * @param int $objectDecodeType
     * @return mixed
     * @throws Zend_Json_Exception
     */
    public function jsonDecode($encodedValue, $objectDecodeType = Zend_Json::TYPE_ARRAY) {
        switch (true) {
            case (null === $encodedValue)  : $encodedValue = 'null'; break;
            case (true === $encodedValue)  : $encodedValue = 'true'; break;
            case (false === $encodedValue) : $encodedValue = 'false'; break;
            case ('' === $encodedValue)    : $encodedValue = '""'; break;
            default    : // do nothing
        }

        return Zend_Json::decode($encodedValue, $objectDecodeType);
    }
}
