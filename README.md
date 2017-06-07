# Inchoo_PHP7

PHP 7 compatibility extension for Magento 1 core by Inchoo. Article with some tests and stats: [http://inchoo.net/magento/its-alive/](http://inchoo.net/magento/its-alive/).

## Compatibility
Carefully choose the release that's appropriate for your Magento core!

### 1.1.0
Tested on M CE 1.9.2.2 - 1.9.2.4 & M EE 1.14.2.2 - 1.14.2.4. Note that this version is also needed for these cores with SUPEE-8788 applied.

(CE version of extension is in 1.9.2.4 branch, and EE version is in EE branch.)

Older versions of Magento may work, but may also have other problems, not fixed by this extension.

If you can, upgrade to freshest Magento core first. If you can't, this may be a good starting point to make a branch for older versions.

Backwards compatible with PHP. Tested by us on PHP 5.6 & 5.5. Users have reported it working fine even on 5.3.3. Installing the extension before switching to PHP 7 is a good idea.

Read the [Wiki](https://github.com/Inchoo/Inchoo_PHP7/wiki)! It contains a lot of great information and stuff you need to do or know about running M1 on PHP7.

### 2.1.1
Tested on M CE 1.9.3.* & M EE 1.14.3.*.

This version removes all model overwrites and Mage_Core_Model_File_Uploader overload. That's fixed in 1.9.3 core.

Included fixes are:
- incorrect sorting in the calculation of the discount fix
- JSON decoding fix
- resource session fix
- Connect Packager fix
- Topological sort for proper ordering when doing totals calculation

Due to fixes implemented in Magento core, there is no need for different branches for CE and EE any more - this release works for both. 

## 3rd party extensions
May be incompatible with PHP 7. We can't do anything about that. But their authors can.

## License
MIT. (See LICENSE.txt).

## Issues
Yes. _(Of course.)_ See Issues tab. Issue reporting is welcome. Pull requests are welcome. (But read [Wiki](https://github.com/Inchoo/Inchoo_PHP7/wiki) and existing code first.)

## Installation
For Composer install, available on Firegento: http://packages.firegento.com/ . 

For older Magento cores, use 1.9.2.4-dev or dev-EE for Enterprise version. For newer ones, just use current release (2.0.*).

Or just download ZIP of the latest release and copy files to appropriate locations.

Remember to clear the cache. Also, check [Proper Installation](https://github.com/Inchoo/Inchoo_PHP7/wiki/ProperInstallation) Wiki page.

## Test
After installation, run shell/inchoo_php7_test.php. This automated testing tool will check if the extension is successfully installed, is its version appropriate for your Magento Core version, is your server PHP version good, are rewrites in place, etc.