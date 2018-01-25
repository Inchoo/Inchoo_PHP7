<?php

if (!defined('MCRYPT_MODE_ECB')) {
    define('MCRYPT_MODE_ECB', 'ecb');
}
if (!defined('MCRYPT_MODE_CBC')) {
    define('MCRYPT_MODE_CBC', 'cbc');
}
if (!defined('MCRYPT_BLOWFISH')) {
    define('MCRYPT_BLOWFISH', 'blowfish');
}
if (!defined('MCRYPT_RIJNDAEL_128')) {
    define('MCRYPT_RIJNDAEL_128', 'rijndael-128');
}

class Inchoo_PHP7_Model_EncryptionEE extends Enterprise_Pci_Model_Encryption
{
}