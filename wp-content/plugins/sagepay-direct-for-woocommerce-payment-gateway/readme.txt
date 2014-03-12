=== Plugin Name ===
Contributors: swicks
Donate link: http://devicesoftware.com/sagepay-direct-for-woocommerce/
Tags: sagepay, direct, woocommerce, woothemes, devicesoftware
Requires at least: 3.3
Tested up to: 3.8.1
Stable tag: 0.1.7.0

WooCommerce SagePay Direct Payment Gateway

== Description ==

Sagepay Direct payment gateway for Woocommerce.  Once installed, you can configure this through Woocommerce Payment Gateways tab.

Enable the payment gateway and apply your unique Vendor Name provided by SagePay.

Test first using Simulator mode, then Test mode, once your testing has been completed successfully go to Live mode.

As with all direct payment gateways where your customer doesn't leave your website, you will need a valid SSL certificate and PCI DSS certification.

Tested with WooCommerce version 2.0.20 and compatible with version 2.1

== Installation ==
Installation :

1. Download.

2. Upload to your /wp-contents/plugins/ directory.

3. Activate the plugin through the 'Plugins' menu in WordPress.

4. Goto Woocommerce -> Settings and select the Payment Gateways tab and click on SagePay Direct just below the tabs.

Configure Gateway:

1. Add your 'Vendor Name' which would have been supplied by SagePay.

2. Initially set your 'Mode Type' to Simulator and then Test before setting to Live.

3. Select the 'Gateway Currency' to what was agread with your payment gateway provider.

4. Check all cards you will support (this list appears on the frontend).

== Frequently Asked Questions ==
= Does it support 3D Secure =
Yes it does, to enable it you first need to contact SagePay and then turn it on through 'My Sage Pay' and setup rules.

== Screenshots ==

1. Sagepay Direct settings screen
2. Customer payment page
3. Admin Order Transactions


== Changelog ==
= Version 0.1.7.0 - 20140224 =
* FIX - Order confirmation now not returning to empty basket
* Feature - Compatible with 2.0.20 and 2.1

= Version 0.1.6.8 - 20140131 =
* FIX - removed debugging code

= Version 0.1.6.7 - 20140128 =
* SECURITY FIX - Cross Site Scripting (XSS) Vulnerability 
* Feature - Added basket contents to Sagepay basket
* MOD - redefined EURO ISO name

= Version 0.1.6.6 - 20130619 =
* FIX - MU undefined function ds_active_network_plugins() typo

= Version 0.1.6.5 - 20130531 =
* FIX - warning 'in_array' messages appearing
* FIX - SSL hanging on Completed3D page

= Version 0.1.6.4 - 20130523 =
* FIX - added multisite support

= Version 0.1.6.3 - 20130519 =
* FIX - duplicate requests to SagePay's 3D Secure auth page

= Version 0.1.6.2 - 20130412 =
* FIX - case sensitive issue with 'content-type' header on some Sagepay servers - [MALFORMED - The Vendor or VendorName value is required. (Code: 3034)]

= Version 0.1.6.1 - 20130403 =
* FIX - removed active_cards declaration in this version

= Version 0.1.6 - 20130213 =
* FIX - Version 2 Woocommerce compatible
* FIX - Non numeric return statuses
* FIX - Transaction Table not displaying

= Version 0.1.5 - 20130125 =
* Feature - Support for SagePay Token (additional plugin)
* Fix - CSS style for tranaction meta box

= Version 0.1.4 - 20121212 =
* Feature: Localization support

= Version 0.1.3 - 20121103 =
* Feature - Check that Woocommerce is active before initializing.
* Feature - Populated fullname using first & last names from Billing details of registered customer.
* Feature - Added 3D Auth (3D Secure)
* FIX - Transposed first & last names on Billing & Shipping details.
* FIX - Display Transaction ID in order notes

= Version 0.1.1 - 20120205 =
* Feature - Initial release
