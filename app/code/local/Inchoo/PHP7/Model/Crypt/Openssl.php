<?php

class Inchoo_PHP7_Model_Crypt_Openssl extends Varien_Crypt_Abstract
{
    const CIPHER_BLOWFISH = 'blowfish';
    const CIPHER_RIJNDAEL = 'rijndael-128';

    const MODE_ECB = 'ecb';
    const MODE_CBC = 'cbc';

    /**
     * Inchoo_PHP7_Model_Crypt_Openssl constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Initialize OpenSSL key and method
     *
     * @param string $key cipher private key
     * @return $this
     * @throws Varien_Exception
     */
    public function init($key)
    {
        if (!$this->getCipher()) {
            $this->setCipher(self::CIPHER_BLOWFISH);
        }

        if (!$this->getMode()) {
            $this->setMode(self::MODE_ECB);
        }

        //@todo: validate cipher and mode here

        if (!$this->getInitVector() && self::MODE_CBC == $this->getMode()) {
            $ivSize = openssl_cipher_iv_length($this->getOpensslMethod());
            $this->setInitVector(substr(md5(random_bytes($ivSize)), -$ivSize));
        }

        if (strlen($key) == 0) {
            $this->unsKey();
            throw new Varien_Exception('Key should not be empty.');
        }

        $this->setKey($key);

        return $this;
    }

    /**
     * Resolve openssl method name from mcrypt method and mode for supported ciphers
     *
     * @return string
     */
    public function getOpensslMethod()
    {
        switch ($this->getCipher()) {

            case self::CIPHER_RIJNDAEL:

                $opensslMethod = 'aes-';
                $keyLength = strlen($this->getKey());

                if($keyLength <= 16) {
                    $opensslMethod .= '128';
                } elseif ($keyLength <= 24) {
                    $opensslMethod .= '192';
                } else {
                    $opensslMethod .= '256';
                }

                break;

            case self::CIPHER_BLOWFISH:
            default:
                $opensslMethod = 'bf';
        }

        $opensslMethod .= '-' . $this->getMode();

        return $opensslMethod;
    }

    /**
     * Encrypt data
     *
     * @param string $data source string
     * @return string
     * @throws Varien_Exception
     */
    public function encrypt($data)
    {
        if (!$this->getKey()) {
            throw new Varien_Exception('Crypt module is not initialized.');
        }
        if (strlen($data) == 0) {
            return $data;
        }

        /**
         * Add zero padding manually to be compatible with old mcrypt padding
         */

        $blockSize = ($this->getCipher() == self::CIPHER_RIJNDAEL) ? 16 : 8;

        $modus = strlen($data) % $blockSize;
        if ($modus > 0) {
            $data .= str_repeat("\0", $blockSize - $modus);
        }

        $encryptedData = openssl_encrypt(
            $data,
            $this->getOpensslMethod(),
            $this->getKey(),
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $this->getInitVector()
        );

        if ($encryptedData === false) {
            return '';
        } else {
            return $encryptedData;
        }
    }

    /**
     * Decrypt data
     *
     * @param string $data encrypted string
     * @return string
     * @throws Varien_Exception
     */
    public function decrypt($data)
    {
        if (!$this->getKey()) {
            throw new Varien_Exception('Crypt module is not initialized.');
        }

        if (strlen($data) == 0) {
            return $data;
        }

        $decryptedData = openssl_decrypt(
            $data,
            $this->getOpensslMethod(),
            $this->getKey(),
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $this->getInitVector()
        );

        if ($decryptedData === false) {
            return '';
        } else {
            /**
             * Remove zero padding
             */
            $decryptedData = rtrim($decryptedData, "\0");
            return $decryptedData;
        }
    }

}