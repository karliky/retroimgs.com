<?php
/**
 * Short description for site.php
 *
 * Long description for site.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Rifaila.com
 *
 * Licensed under tbd
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.es
 * @link          www.rifalia.es
 * @package       rifalia
 * @subpackage    rifalia.controllers.components
 * @since         v 1.0 (23-Jun-2009)
 * @license       tbd
 */

/**
 * SiteComponent class
 *
 * @uses          Object
 * @package       rifalia
 * @subpackage    rifalia.controllers.components
 */
class SiteComponent extends Object {

/**
 * initialize method
 *
 * @param mixed $controller
 * @return void
 * @access public
 */
	function initialize(&$controller) {
		$domain = env('HTTP_HOST');
		$site = MiCache::data('Organization', 'byDomain', array($domain));
		Configure::write('App.site_id', $site);
		if (isProduction() && !$site) {
			$domain = MiCache::data('Organization', 'field', array('domain', array('Organization.is_main_site' => 1)));
			return $controller->redirect('http://' . $domain);
		}
		if (!$domain || !$site) {
			return;
		}
		$folder = strtolower(trim(preg_replace('@[^0-9a-zA-Z]+@', '_', $domain), '_'));
		MiCache::config(array('name' => $domain, 'path' => "data/$domain/"));
	}

/**
 * startup method
 *
 * @param mixed $controller
 * @return void
 * @access public
 */
	function startup(&$controller) {
		if ($controller->Session->check('Auth.User.id')) {
			if ($controller->Session->read('Auth.User.is_admin') === null) {
				$isAdmin = ClassRegistry::init('Membership')->field('is_admin', array(
					'user_id' => $controller->Session->read('Auth.User.id'),
					'organization_id' => Configure::read('App.site_id')
				));
				$controller->Session->write('Auth.User.is_admin', $isAdmin);
			}
		}
	}
}