# Change Log
## [1.0.7] - 2017-02-02
### Changed
- fixed rewrite conflict with AvS_FastSimpleImport - @sprankhub

### Removed
- removed XML totals sort order fix from config.xml

### Added
- topological sort implemented in Mage_Sales_Model_Config_Ordered override (this should fix not only Magento Core problems with totals sorting, but also ensure 3rd party extensions which add something to totals work properly with PHP 7.)

## [1.0.6] - 2016-09-08
### Added
- changelog.md, because we really should have this, so I guess it's better to start late than never...
- protected $_moduleName = 'Mage_Core'; in helper overwrite (should fix translation problems).

### Changed
- README.md updated with slightly more information.

## [1.0.5] - 2016-08-19
_Last version without a changelog._
