<?php
/**
 * Short description for raffles_controller.php
 *
 * Long description for raffles_controller.php
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
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (07-Jun-2009)
 * @license       tbd
 */

/**
 * RafflesController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class RafflesController extends AppController {

/**
 * scaffold property
 *
 * @var array
 * @access public
 */
	var $scaffold = array('index', 'add', 'edit', 'delete', 'winner');

/**
 * name property
 *
 * @var string 'Raffles'
 * @access public
 */
	var $name = 'Raffles';

/**
 * winner method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function winner($id) {

		// TODO: Check admin role

		$result = $this->Raffle->Ticket->find(array('raffle_id' => $id), "id", array('rand()'));
		$winner = $result["Ticket"]["id"];

		$this->Session->setFlash('And the winner is... '.$winner);
	}
}
?>
