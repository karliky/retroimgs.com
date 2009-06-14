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

/**
 * reserved_ticket method
 *
 * @param mixed $code null
 * @param mixed $raflle_id null
 * @param mixed $user_id null
 * @return void
 * @access public
 */
    function reserved_ticket($code = null, $raflle_id = null, $user_id = null) {
		if (empty($code)) {
			return false;
		}
		$raffle = $this->Raffle->find('first', array(
			'fields' => array('id', 'available_tickets', 'ticket_price'),
			'conditions' => array('id' =>  $raffle_id),
			'recursive' => -1
		);
		if (empty($raffle)) {
			return false;
		}
		$result = $this->find('count', array(
			'conditions' => array(
				'raffle_id' => $raffle_id,
				'code' => $code,
				'user_id' => null
			),
			'recursive' => -1
		));
		if ($result) {// El numero está libre;
			if ($this->User->have_money($price)){
				$this->User->charge_money($price);

			}
			//Genero ticket Generoticket($number)
			//Genero Order  GeneroOrder($ticket)
			//Modifico Rifa  Modificorifa(vendidos + 1)
		}
	}
}