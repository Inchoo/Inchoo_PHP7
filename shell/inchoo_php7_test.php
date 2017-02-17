<?php
require_once 'abstract.php';
/**
 * Created on: 13.02.17.
 * Inchoo d.o.o.
 *
 * Test if Inchoo_PHP is installed and integrated into Magento correctly.
 *
 * TODO: test all rewrites
 * TODO: check PHP version vs Mcrypt. Sugest Mcrypt polyfill on PHP 7.1 (But recommend not using PHP 7.1)
 * IDEA: for testing core overwrites - implement a const in those classes, so we can check for its existence
 *
 * @author Ivan Čurdinjaković <ivan.curdinjakovic@inchoo.net>
 */
class Inchoo_PHP7_Test extends Mage_Shell_Abstract
{
    private $testsSuccessful = 0;
    private $testsRun = 0;
    /** @var Mage_Core_Helper_Data $coreHelper */
    private $coreHelper;

    /**
     * Prepare stuff (note that this is Magento constructor, not PHP one)
     */
    protected function _construct()
    {
        $this->coreHelper = Mage::helper('core');
    }

    private function isEnabled(): bool
    {
        return $this->coreHelper->isModuleEnabled('Inchoo_PHP7');
    }

    private function isCoreHelperRewritten(): bool
    {
        return (get_class($this->coreHelper) === 'Inchoo_PHP7_Helper_Data');
    }

    private function isCoreLayoutRewritten(): bool
    {
        return (get_class(Mage::getModel('core/layout')) === 'Inchoo_PHP7_Model_Layout');
    }

    /**
     * Check if extension version is appropriate for M core
     * @return int Extension major version: 1 or 2
     */
    private function checkExtensionAndCoreVersions(): int
    {
        $this->testsRun++;
        $mCoreVersion = Mage::getVersion();
        $extensionVersion = Mage::getConfig()->getNode('modules/Inchoo_PHP7/version');
        $extensionMajorVersion = (int)substr($extensionVersion, 0, 1);
        $edition = Mage::getEdition();

        echo "$this->testsRun: ";
        echo "Inchoo_PHP7 version is: $extensionVersion, Magento core version is: $edition $mCoreVersion - ";

        if ($edition === 'Enterprise') {
            if ($extensionMajorVersion == 1) {
                if (version_compare($mCoreVersion, '1.14.2.0') >= 0 && version_compare($mCoreVersion, '1.14.3.0') < 0){
                    $this->testsSuccessful++;
                    echo "Ok.\n";
                } elseif (version_compare($mCoreVersion, '1.14.3.0') >= 0){
                    exit("You need version 2.* of Inchoo_PHP7 extension for this core!\n");
                } else {
                    echo "Magento core version is too low. This MAY or MAY NOT work!";
                }
            } else {
                // TODO: implement for extension v2
            }
        } elseif ($edition === 'Community'){
            // TODO: implement for community and extension v1 & v2
        } else {
            exit ("This edition of Magento is NOT supported: $edition!");
        }

        return $extensionMajorVersion;
    }

    private function checkPHPVersion()
    {
        $this->testsRun++;

        echo "$this->testsRun: ";

        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $this->testsSuccessful++;
            if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
                echo "CLI version of PHP is too high: ".PHP_VERSION." - this can work on PHP 7.1, but logs will be "
                    ."filled with warnings. It's better to run on 7.0 (Note that CLI and web server versions of PHP may"
                    ." differ.)\n";
            } else {
                echo "CLI version of PHP is Ok: ".PHP_VERSION." (Note that CLI and web server versions of PHP may"
                ." differ.)\n";
            }
        } else {
            exit("You can't run this script on PHP < 7.0. CLI PHP version is: ".PHP_VERSION."\n");
        }
    }

    private function doTest(callable $test, string $success, string $failure): bool
    {
        $this->testsRun++;
        $result = call_user_func($test);
        $this->testsSuccessful += (int)$result;

        echo "$this->testsRun: ";
        echo $result ? "$success\n" : "$failure\n";

        return $result;
    }

    private function doHaltingTest(callable $test, string $success, string $failure)
    {
        $result = $this->doTest($test, $success, $failure);

        if (!$result) exit("Testing stopped, can't test any further until these problems are resolved.");
    }

    /**
     * Do tests
     */
    public function run()
    {
        echo "Running tests...\n";

        $this->checkPHPVersion();
        $this->doHaltingTest(
            [$this, 'isEnabled'],
            'Inchoo_PHP7 module is enabled.',
            'Inchoo_PHP7 module is NOT enabled!'
        );
        $extensionVersion = $this->checkExtensionAndCoreVersions();

        // TODO: branch to tests appropriate for this version

        // Note: core helper rewrite is fixed on Wheelership
        /*$this->doTest(
            [$this, 'isCoreHelperRewritten'],
            'Core helper is rewritten.',
            'Core helper rewrite PROBLEM!'
        );*/
        $this->doTest(
            [$this, 'isCoreLayoutRewritten'],
            'Core layout model is rewritten',
            'Core layout model rewrite PROBLEM!'
        );

        echo "Tests successful: $this->testsSuccessful/$this->testsRun.\n";
    }
}

$shell = new Inchoo_PHP7_Test();
$shell->run();