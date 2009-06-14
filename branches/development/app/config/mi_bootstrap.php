<?php
/* SVN FILE: $Id$ */

/**
 * Short description for bootstrap.php
 *
 * Long description for bootstrap.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2008, Andy Dawson
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2008, Andy Dawson
 * @link          www.ad7six.com
 * @package       base
 * @subpackage    base.app.config
 * @since         v 1.0
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
//EOF
if (!defined('SITE_VERSION')) {
	if (file_exists('.git/refs/heads/master')) {
		define('SITE_VERSION', trim(file_get_contents(APP . '.git/refs/heads/master')));
	} elseif (file_exists(APP . '.svn' . DS . 'entries')) {
		$svn = file(APP . '.svn' . DS . 'entries');
		if (is_numeric(trim($svn[3]))) {
			$version = $svn[3];
		} else { // pre 1.4 svn used xml for this file
			$version = explode('"', $svn[4]);
			$version = $version[1];
		}
		define ('SITE_VERSION', trim($version));
		unset ($svn);
		unset ($version);
	} else {
		define ('SITE_VERSION', filemtime(CONFIGS . 'bootstrap.php'));
	}
}
Configure::write('MiCompressor.timestamp', SITE_VERSION);

/**
 * Lazy devs debugging function.
 *
 * Written with debugging loops or deeply nested code in mind
 *
 * d(null, true); - start debugging
 * d(null, false); - stop debugging
 * d($something) - if started, output debug. Otherwise: do nothing
 *
 * @param mixed $what
 * @param mixed $start null
 * @return void
 * @access public
 */
function d($what, $start = null) {
	static $initialized = false;
	if ($what === null || $start !== null) {
		$initialized = $start;
		if ($what === null) {
			return $initialized;
		}
	}
	if ($initialized && Configure::read() > 0) {
		$calledFrom = debug_backtrace();
		echo '<strong>' . Debugger::trimPath($calledFrom[0]['file']) . '</strong>';
		echo ' (line <strong>' . $calledFrom[0]['line'] . '</strong>)';
		echo "\n<pre class=\"cake-debug\">\n";
		echo htmlspecialchars(var_export($what, true));
		echo "\n</pre>\n";
		return true;
	}
	return false;
}
$langs = array('en', 'es');
sort($langs);
Configure::write('Languages.all', $langs);

/**
 * svnRevision method
 *
 * Get the svn revision for a specific file
 *
 * @param mixed $file
 * @return void
 * @access public
 */
function svnRevision($file) {
	$contents = file_get_contents($file);
	preg_match('/@version\s*\$Revision:\s*(\d*)\s\$/', $contents, $result);
	if ($result) {
		return $result[1];
	}
	return false;
}
?>