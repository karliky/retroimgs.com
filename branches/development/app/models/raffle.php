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
		'Organization',
	);

/**
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
		'MainPrize' => array(
			'className' => 'Prize',
			'conditions' => array(
				'MainPrize.position' => 1
			)
		)
	);

/**
 * beforeSave method
 *
 * @return void
 * @access public
 */
	function beforeSave() {
		$this->begin();
		return true;
	}

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
				$this->_createTickets($this->id, $this->data['Raffle']['available_tickets']);
				$this->Prize->id = $this->data['Raffle']['product_id'];
				$product = $this->Prize->saveField('is_on_raffle', true);
			}
		}
		$this->commit();
	}

/**
 * createTickets method
 *
 * @param mixed $id
 * @param mixed $limit
 * @return void
 * @access protected
 */
	function _createTickets($id, $limit) {
		$this->query("CALL CreateTickets($id, $limit);");
		ClassRegistry::init('Ticket')->randomize(array('Ticket.raffle_id' => $id));
	}

/**
 * featured method
 *
 * @TODO stub
 * @param mixed $limit
 * @param array $params array()
 * @return void
 * @access public
 */
	function featured($limit, $params = array()) {
		$params['limit'] = $limit;
		return $this->find('all', $params);
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

/**
 * winner method
 *
 * Find the winner for the raffle
 *
 * If $perform is true and there is no existing winner - make a winner and return them
 *
 * @param mixed $id null
 * @param bool $perform false
 * @return void
 * @access public
 */
	function winner($id = null, $perform = false) {
		if ($id) {
			$this->id = $id;
		}
		if (!$this->id || !$this->exists()) {
			return false;
		}
		$this->read(array('id', 'winner_id', 'winner_code'));
		if(!empty($this->data[$this->alias]['winner_id'])) {
			$this->data[$this->alias]['existing'] = true;
			return $this->data[$this->alias];
		}

		$result = $this->Ticket->find('first', array(
			'conditions' => array(
				'raffle_id' => $this->id,
				'NOT' => array('Ticket.user_id' => null)
			),
			'fields' => array('user_id', 'code'),
			'order' => 'rand()'
		));
		if (!$result || !$perform) {
			return false;
		}

		$toSave = array(
			'winner_id'=> $result['Ticket']['user_id'],
			'winner_code'=> $result['Ticket']['code'],
			'is_assigned' => true,
			'assigned' => date('Y-m-d H:i:s')
		);
		if ($this->save($toSave)) {
			return array(
				'existing' => false,
				'winner_id' => $result['Ticket']['user_id'],
				'winner_code'=> $result['Ticket']['code'],
			);
		}
		return false;
	}
}