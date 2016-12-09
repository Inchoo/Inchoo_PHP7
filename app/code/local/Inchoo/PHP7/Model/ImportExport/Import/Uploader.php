<?php
class Inchoo_PHP7_Model_ImportExport_Import_Uploader extends Mage_ImportExport_Model_Import_Uploader
{
    /**
     * Validate uploaded file by type and etc.
     */
    protected function _validateFile()
    {
        $filePath = $this->_file['tmp_name'];
        if (is_readable($filePath)) {
            $this->_fileExists = true;
        } else {
            $this->_fileExists = false;
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!$this->checkAllowedExtension($fileExtension)) {
            throw new Exception('Disallowed file type.');
        }
        //run validate callbacks
        foreach ($this->_validateCallbacks as $params) {
            if (is_object($params['object']) && method_exists($params['object'], $params['method'])) {
                //$params['object']->$params['method']($filePath);
                $params['object']->{$params['method']}($filePath);  // PHP7 Fix
            }
        }
    }
}