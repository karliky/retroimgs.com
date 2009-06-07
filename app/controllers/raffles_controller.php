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
	var $scaffold = array('index', 'add', 'edit', 'delete', 'winner', 'view');

/**
 * name property
 *
 * @var string 'Raffles'
 * @access public
 */
	var $name = 'Raffles';

	function index() {
		$this->set('data', $this->paginate());
	}

/**
 * view method
 *
 * @param $id
 * @return void
 * @access public
 */
	function view($id) {
		$result = $this->Raffle->find(array('Raffle.id' => $id ));
		$this->set('availableTickets', $result["Raffle"]["available_tickets"]);
		$this->set('soldTickets', $result["Raffle"]["sold_tickets"]);
		$this->set('remainingTickets', $result["Raffle"]["available_tickets"] - $result["Raffle"]["sold_tickets"]);

		if(!empty($result["Raffle"]["winner_id"])){
			$user = $this->Raffle->Ticket->User->find(array("id" => $result["Raffle"]["winner_id"]));
			$this->set('winner_id', $result["Raffle"]["winner_id"]);	
			$this->set('winner_user', $user["User"]["login"]);	
			$this->set('winner_code', $result["Raffle"]["winner_code"]);	
		}

		$result = $this->Raffle->Product->find(array('raffle_id' => $id ));
		$this->set('productDescription', $result["Product"]["description"]);
		$this->set('productShortDescription', $result["Product"]["short_description"]);
		$this->set('price', $result["Product"]["price"]);
	}

/**
 * winner method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function winner($id) {

		$result = $this->Raffle->Ticket->find(array('raffle_id' => $id, "not" => array("Ticket.user_id" => null)), array("id", "code"), array('rand()'));
		$winner = $result["Ticket"]["id"];
		$winnerCode = $result["Ticket"]["code"];

		$this->set('winner', $winner);
		$this->set('raffle', $id);

		if(!empty($winner)) {
			$raffle = $this->Raffle->find(array('Raffle.id' => $id));
			$raffle["Raffle"]["winner_id"] = $winner;
			$raffle["Raffle"]["winner_code"] = $winnerCode;
			$raffle["Raffle"]["is_assigned"] = 1;
			$raffle["Raffle"]["assigned"] = date('Y-m-d H:i:s');
			$this->Raffle->save($raffle);
		}

		$this->Session->setFlash('And the winner is... '.$winner);
	}
}
?>
