<?php
/**
 * Short description for membership.php
 *
 * Long description for membership.php
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
 * Membership class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Membership extends AppModel {

/**
 * name property
 *
 * @var string 'Membership'
 * @access public
 */
	var $name = 'Membership';

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Organization',
		'User',
	);
}