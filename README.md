# Inchoo_PHP7

PHP 7 compatibility extension for Magento 1 by Inchoo. Article with some tests and stats: http://inchoo.net/magento/its-alive/ .

## Compatibility
Tested on M CE 1.9.2.2 & 1.9.2.3. Reported working on M EE 1.14.2.2. Older versions of Magento may work, but may also have other problems, not fixed by this extension.

If you can, upgrade to freshest Magento core first. If you can't, this may be a good starting point to make a branch for older versions.

Backwards compatible with PHP. Tested by us on PHP 5.6 & 5.5. Users have reported it working fine even on 5.3.3. Installing the extension before switching to PHP 7 is a good idea.

## License
MIT. (See LICENSE.txt).

## Issues
Yes. _(Of course.)_ See Issues tab. Issue reporting is welcome. Pull requests are welcome.

## Instalation
For Composer install, available on Firegento: http://packages.firegento.com/ .

Or just download ZIP and copy files to appropriate locations.

## PHP 7 & mod_php
If you are using mod_php (quite common on development localhosts), remember to edit your .htaccess file, because settings under

    <IfModule mod_php5.c>

will not be set. You can leave that block in case of reverting to PHP 5, but add something like this one too:

    <IfModule mod_php7.c>
        php_value memory_limit 256M
        php_value max_execution_time 18000
        php_flag session.auto_start off
    </IfModule>
