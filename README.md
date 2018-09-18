# Deprecation notice

**Magento released official PHP 7.2 patches for Magento 1 (September 2018), 
which means this extension is not needed anymore!!**

**Remove this module from your M1 store and use official patches.**

More info:  
https://inchoo.net/magento/magento-1-official-php-7-2-patches/

Patches:  
https://magento.com/tech-resources/download#download2240

# Inchoo_PHP7

PHP 7 compatibility extension for Magento 1 core by Inchoo. 
Article with some tests and stats: [http://inchoo.net/magento/its-alive/](http://inchoo.net/magento/its-alive/).

Read the [Wiki](https://github.com/Inchoo/Inchoo_PHP7/wiki)! It contains a lot of great information and stuff you need to do or know about running M1 on PHP7.

## Compatibility

### 3.0.0 RC
For Magento CE 1.9.3.* on PHP 7.0 and PHP 7.1 (recommended).

This version introduced PHP 7.1 and 7.2 fixes and solution for deprecated mcrypt.
It works on PHP 7.2 but most testing was done for 7.1.

We don't support older Magento versions anymore. Consider upgrading Magento since new versions patched multiple PHP 7 related things.


### 2.x
For Magento CE 1.9.3.* on PHP 7.0.

This version removed most overwrites from v.1.x since Magento implemented fixes in 1.9.3 core. 
It was fully compatible with Magento EE 1.14.3.x on PHP 7.0.

### 1.x
For Magento CE 1.9.2.2 - 1.9.2.4 on PHP 7.0.  
Note that this version is also needed for  cores with SUPEE-8788 applied.

### Magento Enterprise
Read [EE Wiki](#) and check [EE branch](#).

We can't overwrite and publicly release some parts of EE due to copyright issues, 
but we're trying to be fully compatible and release what we can.

## 3rd party extensions
May be incompatible with PHP 7. We can't do anything about that. But their authors can.

## License
MIT. (See LICENSE.txt).

## Issues
Yes. _(Of course.)_ See Issues tab. Issue reporting is welcome. Pull requests are welcome. 
(But read [Wiki](https://github.com/Inchoo/Inchoo_PHP7/wiki) and existing code first.)

## Installation
Just download ZIP of the latest release and copy files to appropriate locations.

For Composer install, it's available on Firegento: http://packages.firegento.com/ . 

Remember to clear the cache.

Extension is backwards compatible with PHP. Tested by us on PHP 5.6 & 5.5. Users have reported it's working fine even on 5.3.3. Installing the extension before switching to PHP 7 is a good idea.

