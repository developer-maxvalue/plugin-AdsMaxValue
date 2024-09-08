=== Ads.txt Manager ===
Contributors:      trunbiz, maxvaluemedia
Tags:              ads.txt,  ads, ad manager, dashboard, reports
Tested up to:      1.0
Stable tag:        1.0
License:           GPL-2.0-or-later
License URI:       https://spdx.org/licenses/GPL-2.0-or-later.html

Create, manage, and validate your ads.txt and view dashboard, reports admaxvalue.media from within WordPress, like any other content asset.

== Description ==

Create, manage, and validate your ads.txt and app-ads.txt from within WordPress, like any other content asset. Requires PHP 7.4+ and WordPress 5.7+.

=== What is ads.txt? ===

Ads.txt is an initiative by the Interactive Advertising Bureau to enable publishers to take control over who can sell their ad inventory. Through our work at 10up with various publishers, we've created a way to manage and validate your ads.txt file from within WordPress, eliminating the need to upload a file. The validation baked into the plugin helps avoid malformed records, which can cause issues that end up cached for up to 24 hours and can lead to a drop in ad revenue.

=== Technical Notes ===

* Requires PHP 7.4+.
* Requires WordPress 6.3+.
* Ad blockers may break syntax highlighting and pre-save error checking on the edit screen.
* Your site URL must not contain a path (e.g. `https://example.com/site/` or path-based multisite installs). While the plugin will appear to function in the admin, it will not display the contents at `https://example.com/site/ads.txt`. This is because the plugin follows the IAB spec, which requires that the ads.txt file be located at the root of a domain or subdomain.

=== Can I use this with multisite? ===

Yes! However, if you are using a subfolder installation it will only work for the main site.

== Installation ==
1. Install the plugin via the plugin installer, either by searching for it or uploading a .zip file.
2. Activate the plugin.
3. Head to Settings → Ads.txt or App-ads.txt and add the records you need.
4. Check it out at yoursite.com/ads.txt or yoursite.com/app-ads.txt!

Note: If you already have an existing ads.txt or app-ads.txt file in the web root, the plugin will not read in the contents of the respective files, and changes you make in WordPress admin will not overwrite contents of the physical files.