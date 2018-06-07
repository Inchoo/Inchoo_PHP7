<?php

class Inchoo_PHP7_Helper_Data extends Mage_Core_Helper_Data
{
    /** @var string $_moduleName Compatibility for translations, and maybe other stuff which uses module names. */
    protected $_moduleName = 'Mage_Core';

    /**
     * @return Mage_Core_Model_Encryption
     */
    public function getEncryptor()
    {
        if ($this->_encryptor === null) {

            $encryptionModel = (string)Mage::getConfig()->getNode(self::XML_PATH_ENCRYPTION_MODEL);

            /**
             * PHP 7.1 fix.
             * EE only, switch default EE encryptor to Inchoo encryption model to resolve missing constants.
             *
             * (this is here to avoid major problems when someone is using Inchoo_PHP7 for CE on EE)
             */
            if($encryptionModel == 'Enterprise_Pci_Model_Encryption') {
                $encryptionModel = 'Inchoo_PHP7_Model_EncryptionEE';
            }
            //

            if ($encryptionModel) {
                $this->_encryptor = new $encryptionModel;
            } else {
                $this->_encryptor = Mage::getModel('core/encryption');
            }

            $this->_encryptor = new $encryptionModel;
            $this->_encryptor->setHelper($this);
        }
        return $this->_encryptor;
    }

    /**
     * Decodes the given $encodedValue string which is encoded in the JSON format
     *
     * PHP 7.0 fix, overridden to prevent exceptions in json_decode
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
