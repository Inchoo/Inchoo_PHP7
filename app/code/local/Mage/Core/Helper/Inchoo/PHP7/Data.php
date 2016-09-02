<?php

class Mage_Core_Helper_Inchoo_PHP7_Data extends Mage_Core_Helper_Data {

    /**
     * Decodes the given $encodedValue string which is
     * encoded in the JSON format
     *
     * Overridden to prevent exceptions in json_decode
     *
     * @param string $encodedValue
     *
     * @return mixed
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