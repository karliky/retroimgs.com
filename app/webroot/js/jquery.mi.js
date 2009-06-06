/* SVN FILE: $Id$ */

/*!
 * mi.js - common utility functions
 *
 * @package       base
 * @copyright     Copyright (c) 2009, Andy Dawson
 * @link          www.ad7six.com
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
$(function() {
	$.extend({

/**
 * Make the ajax calls base-url (subfolder) independent
 * call $.('/a/url') to get /cakeInstallIsHere/a/url out
 * If there is no subfolder, the passed argument is returned directly
 */
		url: function(url) {
			return url;
		}
	});
});
