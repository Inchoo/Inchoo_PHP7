<?php

if (Mage::helper('core')->isModuleEnabled('AvS_FastSimpleImport')) {
    abstract class Inchoo_PHP7_Model_Import_Entity_Product_Abstract
        extends AvS_FastSimpleImport_Model_Import_Entity_Product
    {
        // empty class
    }
} else {
    abstract class Inchoo_PHP7_Model_Import_Entity_Product_Abstract
        extends Mage_ImportExport_Model_Import_Entity_Product
    {
        // empty class
    }
}

/**
 * Created on: 12.08.16.
 * @author Oliver Ernst <ernst.o@idowapro.de>
 */
class Inchoo_PHP7_Model_Import_Entity_Product extends Inchoo_PHP7_Model_Import_Entity_Product_Abstract
{

    /**
     * Returns an object for upload a media files
     */
    protected function _getUploader()
    {
        if (is_null($this->_fileUploader)) {
            $this->_fileUploader = Mage::getModel("importexport/import_uploader", null);

            $this->_fileUploader->init();

            $tmpDir     = Mage::getConfig()->getOptions()->getMediaDir() . '/import';
            $destDir    = Mage::getConfig()->getOptions()->getMediaDir() . '/catalog/product';
            if (!is_writable($destDir)) {
                @mkdir($destDir, 0777, true);
            }
            if (!$this->_fileUploader->setTmpDir($tmpDir)) {
                Mage::throwException("File directory '{$tmpDir}' is not readable.");
            }
            if (!$this->_fileUploader->setDestDir($destDir)) {
                Mage::throwException("File directory '{$destDir}' is not writable.");
            }
        }
        return $this->_fileUploader;
    }

}
