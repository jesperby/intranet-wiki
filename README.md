Intranet Wiki
=============
MediaWiki skin for the intranet wiki at Malmö stad. Forked from the Wikipedia Vector skin.

The skin is using Malmö stads’s intranet global assets, see the repo [intranet-assets](https://github.com/malmostad/intranet-assets).

For more information about the intranet wiki, contact kominteamet@malmo.se.

## Dependencies
* MediaWiki > 1.20.2
* MediaWiki compatible database
* LDAP server for authentication
* SSL certificate
* Dynamic linking to Malmö stad’s assets.
* MediaWiki extensions used:
  * Cite
  * ConfirmEdit
  * Gadgets
  * Nuke
  * ParserFunctions
  * Vector
  * WikiEditor

## Setup
* Perform a regular MediaWiki installation.
* Copy and edit the following files from this code base (do __not__ check in config files in the repository):
  * `LocalSettings-example.php` to `LocalSettings.php`
  * `.htaccess-example` to `.htaccess`

## Licence
Released under GPL version 2.
