<?php
/**
 * Created on: 15.12.15.
 * Inchoo d.o.o.
 * @author Ivan Čurdinjaković <ivan.curdinjakovic@inchoo.net>
 */ 
class Inchoo_PHP7_Model_File_Uploader extends Mage_Core_Model_File_Uploader
{
    protected function _validateFile()
    {
        if ($this->_fileExists === false) {
            return;
        }

        //is file extension allowed
        if (!$this->checkAllowedExtension($this->getFileExtension())) {
            throw new Exception('Disallowed file type.');
        }
        //run validate callbacks
        foreach ($this->_validateCallbacks as $params) {
            if (is_object($params['object']) && method_exists($params['object'], $params['method'])) {
                $params['object']->{$params['method']}($this->_file['tmp_name']);
            }
        }
    }
}