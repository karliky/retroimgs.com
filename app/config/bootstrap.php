<?php
/* SVN FILE: $Id$ */

/**
 * Short description for bootstrap.php
 *
 * Long description for bootstrap.php
 *
 * PHP version 4 and 5
 *
 * Copyright (c) 2009, Andy Dawson
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Andy Dawson
 * @link          www.ad7six.com
 * @package       base
 * @subpackage    base.config
 * @since         v 1.0
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

$base = ROOT . DS . 'base' . DS;
$controllerPaths  = array($base . 'controllers' . DS);
$componentPaths   = array($base . 'controllers' . DS . 'components' . DS);
$modelPaths       = array($base . 'models' . DS);
$localePaths      = array($base . 'locale' . DS);
$behaviorPaths    = array($base . 'models' . DS . 'behaviors' . DS);
$viewPaths        = array($base . 'views' . DS);
$helperPaths      = array($base . 'views' . DS . 'helpers' . DS);
$vendorPaths      = array($base . 'vendors' . DS);

Configure::write('Security.level', 'low');
//Configure::write('Session.start', false);
Configure::write('Session.cookie', 'RIFALIA');

/**
 * isproduction method
 * a stub/example
 *
 * use sparingly - won't work from a shell
 *
 * @return boolean
 * @access public
 */
function isproduction() {
	if (!isset($_server['http_host'])) {
		return false;
	}
	return ($_server['http_host'] === 'www.rifalia.com' && $_server['script_name'] === '/index.php');
}

/**
 * isstaging method
 * a stub/example
 *
 * use sparingly - won't work from a shell
 *
 * @return boolean
 * @access public
 */
function isstaging() {
	if (!isset($_server['http_host'])) {
		return false;
	}
	return ($_server['http_host'] === 'staging.rifalia.com'); // running in a subdomain
	//return ($_server['http_host'] === 'www.rifalia.com' && $_server['script_name'] !== '/index.php'); // running in a subfolder
}

/**
 * isdevelopment method
 * a stub/example
 *
 * use sparingly - won't work from a shell
 *
 * @return boolean
 * @access public
 */
function isdevelopment() {
	return (!isproduction() && !isstaging());
}
include('mi_bootstrap.php');
?>