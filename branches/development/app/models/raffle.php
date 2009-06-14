<?php
/**
 * Short description for raffle.php
 *
 * Long description for raffle.php
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
 * Raffle class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Raffle extends AppModel {

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Winner' => array('className' => 'User'),
		'Product',
	);

/**
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
	);

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array(
		'Ticket',
	);

/**
 * afterSave method
 *
 * If it's a newly created Raffle, create all the tickets
 *
 * @param mixed $created
 * @return void
 * @access public
 */
	function afterSave($created) {
		if ($created) {
			if (!empty($this->data)) {
				$aTickets = array();
				for($i=0; $i<$this->data['Raffle']['available_tickets']; $i++) {
					$aTickets[$i] = array('code' => $i, 'raffle_id' => $this->id);
				}
				$this->Ticket->saveAll($aTickets);
				$product = $this->Ticket->Raffle->Product->find(array('Product.id' => $this->data['Raffle']['product_id']));
				$product['Product']['is_on_raffle'] = 1;
				$product = $this->Ticket->Raffle->Product->save($product);
			}
		}
	}

/**
 * ticketsBought method
 *
 * Increment the number of tickets bought for a Raffle
 *
 * @TODO this should be triggered by Ticket::afterSave
 * @param mixed $id - Raffle id
 * @param $number - number of used tickets to add
 * @return void
 * @access public
 */
	function ticketsBought($id, $number) {
		return $this->updateAll(array('Raffle.sold_tickets' => 'Raffle.sold_tickets + ' . $number), array('id' => $id));
	}
}