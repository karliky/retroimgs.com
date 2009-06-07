<?php
/**
 * Short description for ticket.php
 *
 * Long description for ticket.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Rifaila.com
 *
 * Licensed under tbd
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.com
 * @link          www.rifalia.com
 * @package       rifalia
 * @subpackage    rifalia.models
 * @since         v 1.0 (07-Jun-2009)
 * @license       tbd
 */

/**
 * Ticket class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Ticket extends AppModel {

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Raffle',
		'Transaction',
		'User',
	);

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array(
		'Order',
	);
}