=== Shortcode Loan Calculator ===
Contributors: sagaio
Tags: shortcode, shortcode-calculator, calculator, loan, loan-calculator
Requires at least: 4.0
Tested up to: 4.9.8
Stable tag: 1.0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Provides a shortcode [shortcode_loan_calculator] that returns the sum of the values provided in loan and multiplier.

== Installation ==

= From your WordPress dashboard =

Visit 'Plugins > Add New'
Search for and download 'Shortcode Loan Calculator'
Activate Shortcode Loan Calculator from your Plugins page.

= From other sources =

Download Shortcode Loan Calculator.
Upload the 'shortcode-loan-calculator' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
Activate Shortcode Loan Calculator from your Plugins page.

== Frequently Asked Questions ==

= How do I use it? =

You can find all global settings under "Appearance" > "Customize" > "Shortcode Loan Calculator".
There you can set thousands separator, decimals separator, number of decimals and a global multiplier variable.

Example1 without fallback text:
[shortcode_loan_calculator loan="300000" multiplier="0.003403"]

Example2 with fallback text:
[shortcode_loan_calculator loan="300000" multiplier="0.003403" fallback_text="Contact us"]

Example3 with global multiplier:
[shortcode_loan_calculator loan="300000" multiplier="global" fallback_text="Contact us"]

* Example 3 requires you to set a global variable under "Appearance" > "Customize" > "Shortcode Loan Calculator".

= What is the default fallback text? =
The default fallback text is "Contact us for pricing"

= When is the fallback text used? =
When either the "loan" or the "multiplier" fields are not filled.
For example [shortcode_loan_calculator loan="" multiplier="0.003403" fallback_text="This is now displayed instead of the sum"]

== Changelog ==

= 1.0.1 =
*2018-11-14*
* Tested for WordPress 4.9.8

= 1.0.0 =
*2016-11-16*
* First release