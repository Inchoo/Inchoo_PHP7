# Change Log
## Unreleased
### Added
- Mage_ImportExport_Model_Import_Uploader - fix when uploading files (Uncaught Error: Function name must be a string in .../app/code/core/Mage/ImportExport/Model/Import/Uploader.php:135)

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
