# Change Log
## [2.1.0] - 2017-04-05
### Changed
- a bit of love to composer.json (support & suggest sections)

### Added
- shell/inchoo_php7_test.php - initial implementation of a test tool 

## [2.0.1] 2017-02-02
### Removed
- XML totals sort order fix from config.xml

### Added
- topological sort implemented in Mage_Sales_Model_Config_Ordered override (this should fix not only Magento Core problems with totals sorting, but also ensure 3rd party extensions which add something to totals work properly with PHP 7.)

## [2.0.0] 2016-10-18
### Changed
- this is the release for Magento core 1.9.3; older versions are supported from _1.9.2.4_ branch and 1.* releases.

### Removed
- all model overwrites - they are no longer needed.
- Mage_Core_Model_File_Uploader overload - also fixed in new core.

## [1.0.6] - 2016-09-08
### Added
- changelog.md, because we really should have this, so I guess it's better to start late than never...
- protected $_moduleName = 'Mage_Core'; in helper overwrite (should fix translation problems).

### Changed
- README.md updated with slightly more information.

## [1.0.5] - 2016-08-19
_Last version without a changelog._
