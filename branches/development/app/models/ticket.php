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
 * actsAs property
 *
 * @var array
 * @access public
 */
	var $actsAs = array(
		'Random' => array('cache' => false)
	);

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
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
		'Prize' => array(
			'foreignKey' => 'winning_ticket_id'
		)
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
	function buy($ticketId = null, $raffleId = null, $userId = null) {
		if (empty($ticketId) || empty($raffleId) || empty($userId)) {
			return false;
		}
		$available = $this->find('count', array(
			'conditions' => array(
				'id' => $ticketId,
				'user_id' => null
			),
			'recursive' => -1
		));
		if (!$available) {
			return false;
		}
		$price = $this->Raffle->field('price');
		if ($this->User->have_money($price)) {
			$this->User->charge_money($price);

		}
			//Genero ticket Generoticket($number)
			//Genero Order  GeneroOrder($ticket)
			//Modifico Rifa  Modificorifa(vendidos + 1)
	}

/**
 * randomSelect method
 *
 * Returns random ticket number(s) for the given raffle
 *
 * @param int $raffleId
 * @param int $howMany 1
 * @return array
 * @access public
 */
	function randomSelect($raffleId = 0, $howMany = 1) {
		if (!$raffleId) {
			return false;
		}
		$return = $this->find('all', array(
			'recursive' => -1,
			'fields' => array('code', 'id'),
			'conditions' => array(
				'raffle_id' => $raffleId,
				'Ticket.user_id' => null
			),
			'order' => 'RAND()',
			'limit' => $howMany
		));
		if (!$return) {
			return false;
		}
		return Set::combine($return, '/Ticket/id', '/Ticket/code');
	}

/**
 * reserve method
 *
 * @param array $data array()
 * @param int $user_id
 * @return void
 * @access public
 */
	function reserve(&$data = array(), $userId = false) {
		if (empty($data['numbers'])) {
			if ($data['number']) {
				$ticket = $this->findByCodeAndUserId($data['number'], null);
				if ($ticket) {
					$data['numbers'][$ticket['Ticket']['id']] = $ticket['Ticket']['code'];
				}
			} else {
				$numbers = $this->randomSelect($data['raffle_id'], $data['quantity']);
			}
			$data['numbers'] = $numbers;
			return false;
		}
		$data['numbers'] = explode(', ', $data['numbers']);
		$this->begin();
		foreach($data['numbers'] as $i => $ticketNumber) {
			if (!isset($data[$i]['id']) || $data[$i]['id'] != $this->field('id', array('raffle_id' => $data['raffle_id'], 'code' => $ticketNumber))) {
				$this->rollback();
				return false;
			}
			if (!$this->buy($data[$i]['id'], $userId)) {
				$this->rollback();
				return false;
			}
		}
		$this->commit();
		return true;
	}

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
		));
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
			if ($this->User->have_money($price)) {
				$this->User->charge_money($price);

			}
			//Genero ticket Generoticket($number)
			//Genero Order  GeneroOrder($ticket)
			//Modifico Rifa  Modificorifa(vendidos + 1)
		}
	}
}