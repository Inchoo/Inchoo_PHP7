# Inchoo_PHP7

PHP 7 compatibility extension for Magento 1 core by Inchoo. 
Article with some tests and stats: [http://inchoo.net/magento/its-alive/](http://inchoo.net/magento/its-alive/).

## Compatibility

### Magento CE 1.9.3.*  
Extension is compatible and tested with Magento CE 1.9.3.*. It's compatible with PHP 7.0 and 7.1.

### Magento Enterprise 1.14.3.*  
Use EE branch and read EE Wiki.  
We can't rewrite and publicly release some parts of EE due to copyright issues, so we release only what we can. Also, EE has official support. 

### Older Magento CE & EE  
We don't support older Magento CE & EE versions anymore. 
Check 1.9.2.x branch, it could help but we don't test it anymore. 
Consider upgrading Magento since new versions patched multiple PHP 7 related things. Unfortunately, not all :)

## 3rd party extensions
May be incompatible with PHP 7. We can't do anything about that. But their authors can.

## License
MIT. (See LICENSE.txt).

## Issues
Yes. _(Of course.)_ See Issues tab. Issue reporting is welcome. Pull requests are welcome. 
(But read [Wiki](https://github.com/Inchoo/Inchoo_PHP7/wiki) and existing code first.)

## Installation
For Composer install, available on Firegento: http://packages.firegento.com/ . 

Or just download ZIP of the latest release and copy files to appropriate locations.

Remember to clear the cache. Also, check [Proper Installation](https://github.com/Inchoo/Inchoo_PHP7/wiki/ProperInstallation) Wiki page.

## Test
After installation, run shell/inchoo_php7_test.php. This automated testing tool will check if the extension is 
successfully installed, is its version appropriate for your Magento Core version, is your server PHP version good, are rewrites in place, etc.