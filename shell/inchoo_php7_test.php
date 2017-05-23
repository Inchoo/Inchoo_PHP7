<?php

require_once dirname($_SERVER['SCRIPT_FILENAME']) . '/abstract.php';

/**
 * Created on: 13.02.17.
 * Inchoo d.o.o.
 *
 * Test if Inchoo_PHP is installed and integrated into Magento correctly.
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

    /**
     * Check models class name, or parent class name.
     *
     * Parent class name - in case some other rewrite inherits from Inchoo_PHP7, fixing a rewrite conflict.
     *
     * @param object $model
     * @param string $className
     * @return bool
     */
    private function checkRewrite($model, string $className): bool
    {
        return (get_class($model) === $className || get_parent_class($model) === $className);
    }

    /**
     * Checks if a class has INCHOO_PHP7 const, proving it is correctly overriden
     * @param string $class
     * @return bool
     */
    private function checkOverride(string $class): bool
    {
        return defined("$class::INCHOO_PHP7");
    }

    private function isCoreHelperRewritten(): bool
    {
        return $this->checkRewrite($this->coreHelper, 'Inchoo_PHP7_Helper_Data');
    }

    private function isCoreLayoutRewritten(): bool
    {
        return $this->checkRewrite(Mage::getModel('core/layout'), 'Inchoo_PHP7_Model_Layout');
    }

    private function isImportEntityProductRewritten(): bool
    {
        return $this->checkRewrite(
            Mage::getModel('importexport/import_entity_product'),
            'Inchoo_PHP7_Model_Import_Entity_Product'
        );
    }

    private function isExportEntityConfigurableRewritten(): bool
    {
        return $this->checkRewrite(
            Mage::getModel('importexport/export_entity_product_type_configurable'),
            'Inchoo_PHP7_Model_Export_Entity_Product_Type_Configurable'
        );
    }

    private function isExportEntityGroupedRewritten(): bool
    {
        return $this->checkRewrite(
            Mage::getModel('importexport/export_entity_product_type_grouped'),
            'Inchoo_PHP7_Model_Export_Entity_Product_Type_Grouped'
        );
    }

    private function isExportEntitySimpleRewritten(): bool
    {
        return $this->checkRewrite(
            Mage::getModel('importexport/export_entity_product_type_simple'),
            'Inchoo_PHP7_Model_Export_Entity_Product_Type_Simple'
        );
    }

    private function isExportEntityCustomerRewritten(): bool
    {
        return $this->checkRewrite(
            Mage::getModel('importexport/export_entity_customer'),
            'Inchoo_PHP7_Model_Export_Entity_Customer'
        );
    }

    private function isPackagerOverriden(): bool
    {
        return $this->checkOverride('Mage_Connect_Packager');
    }
    private function isUploaderOverriden(): bool
    {
        return $this->checkOverride('Mage_Core_Model_File_Uploader');
    }
    private function isSessionOverriden(): bool
    {
        return $this->checkOverride('Mage_Core_Model_Resource_Session');
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
                    echo "Magento core version is too low. This MAY or MAY NOT work!\n";
                }
            } else {
                if (version_compare($mCoreVersion, '1.14.2.0') >= 0 && version_compare($mCoreVersion, '1.14.3.0') < 0){
                    exit("You need version 1.* of Inchoo_PHP7 extension for this core!\n");
                } elseif (version_compare($mCoreVersion, '1.14.3.0') >= 0){
                    $this->testsSuccessful++;
                    echo "Ok.\n";
                } else {
                    echo "Magento core version is too low. This MAY or MAY NOT work!\n";
                }
            }
        } elseif ($edition === 'Community'){
            if ($extensionMajorVersion == 1) {
                if (version_compare($mCoreVersion, '1.9.2.0') >= 0 && version_compare($mCoreVersion, '1.9.3.0') < 0){
                    $this->testsSuccessful++;
                    echo "Ok.\n";
                } elseif (version_compare($mCoreVersion, '1.9.3.0') >= 0){
                    exit("You need version 2.* of Inchoo_PHP7 extension for this core!\n");
                } else {
                    echo "Magento core version is too low. This MAY or MAY NOT work!\n";
                }
            } else {
                if (version_compare($mCoreVersion, '1.9.2.0') >= 0 && version_compare($mCoreVersion, '1.9.3.0') < 0){
                    exit("You need version 1.* of Inchoo_PHP7 extension for this core!\n");
                } elseif (version_compare($mCoreVersion, '1.9.3.0') >= 0){
                    $this->testsSuccessful++;
                    echo "Ok.\n";
                } else {
                    echo "Magento core version is too low. This MAY or MAY NOT work!\n";
                }
            }
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

        $this->doTest(
            [$this, 'isPackagerOverriden'],
            'Magento Connect Packager is overridden.',
            'Magento Connect Packager override PROBLEM!'
        );
        $this->doTest(
            [$this, 'isSessionOverriden'],
            'Magento Session Resource is overridden.',
            'Magento File Uploader override PROBLEM!'
        );

        // Inchoo_PHP7 1.* specific tests
        if ($extensionVersion === 1) {
            $this->doTest(
                [$this, 'isUploaderOverriden'],
                'Magento File Uploader is overridden.',
                'Magento File Uploader override PROBLEM!'
            );
            $this->doTest(
                [$this, 'isCoreHelperRewritten'],
                'Core helper is rewritten.',
                'Core helper rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isCoreLayoutRewritten'],
                'Core layout model is rewritten.',
                'Core layout model rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isImportEntityProductRewritten'],
                'Core import entity product model is rewritten.',
                'Core import entity product model rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isExportEntityConfigurableRewritten'],
                'Core export entity product configurable model is rewritten.',
                'Core export entity product configurable rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isExportEntityGroupedRewritten'],
                'Core export entity product grouped model is rewritten.',
                'Core export entity product grouped rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isExportEntitySimpleRewritten'],
                'Core export entity product simple model is rewritten.',
                'Core export entity product simple rewrite PROBLEM!'
            );
            $this->doTest(
                [$this, 'isExportEntityCustomerRewritten'],
                'Core export entity customer model is rewritten.',
                'Core export entity customer rewrite PROBLEM!'
            );
        }

        echo "Tests successful: $this->testsSuccessful/$this->testsRun.\n";
    }
}

$shell = new Inchoo_PHP7_Test();
$shell->run();
