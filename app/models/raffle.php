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
		'Winner' => array('className' => 'User')
	);

/**
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
		'Product',
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
					$aTickets[$i] = array('number' => $i, 'raffle_id' => $this->id);
				}
				$this->Ticket->saveAll($aTickets);
			}
		}
	}
}
