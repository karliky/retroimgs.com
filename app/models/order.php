<?php
/**
 * Short description for order.php
 *
 * Long description for order.php
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
 * Order class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Order extends AppModel {

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Ticket',
		'User',
	);

/**
 * generateOrder method
 *
 * @param mixed $ticket_id
 * @param mixed $amount
 * @param mixed $user_id
 * @param mixed $description null
 * @return void
 * @access public
 */
	function generateOrder($ticket_id, $amount, $user_id, $description = null) {
		if (!$description) {
			$description = __('default order description', true);
		}
		$this->create();
		if ($this->save(compact('ticket_id', 'amount', 'user_id', 'description'))) {
			return $this->id;
		}
		return false;
	}
}