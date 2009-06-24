<?php
/**
 * Short description for organization.php
 *
 * Long description for organization.php
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
 * @subpackage    rifalia.models
 * @since         v 1.0 (22-Jun-2009)
 * @license       tbd
 */

/**
 * Organization class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Organization extends AppModel {

/**
 * name property
 *
 * @var string 'Organization'
 * @access public
 */
	var $name = 'Organization';

/**
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
		'ContactMembership' => array(
			'className' => 'Membership',
			'conditions' => array(
				'Contact.is_contact' => true,
				'Contact.contact_priority' => 1
			)
		),
		'Contact' => array(
			'className' => 'User',
			'conditions' => array(
				'User.id = ContactMembership.user_id',
			)
		)
	);

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array(
		'Membership',
	);

/**
 * byDomain method
 *
 * Find the organization ID that 'owns'the domain being requested. if there's no domain found and no organizations
 * exist at all - create the first organization and mark as the main organization. This will be rifalia in the case
 * of the main website
 *
 * @param string $domain ''
 * @return void
 * @access public
 */
	function byDomain($domain = '') {
		$result = $this->field('id', array('domain' => $domain));
		if (!$result && !$this->find('count')) {
			$this->create();
			$this->save(array(
				'is_main_site' => 1,
				'domain' => $domain
			));
			$result = $this->id;
		}
		return $result;
	}
}