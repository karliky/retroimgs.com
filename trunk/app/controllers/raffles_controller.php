<?php
class RafflesController extends AppController {
	var $scaffold = array('index', 'add', 'edit', 'delete', 'winner');

	var $name = 'Raffles';

	//function index() {
		//$this->set('raffles', $this->Raffle->find('all'));
	//}

	/*function add() {
		
		// TODO: check admin role

		if (!empty($this->data)) {
			if ($this->Raffle->save($this->data)) {
				
				// Add tickets
				$aTickets = Array();
				for($i=0; $i<$this->data["Raffle"]["tickets_count"]; $i++) {
					$aTickets[$i] =Array("number" => $i, "raffle" => $this->Raffle->id);
				}
				$this->Raffle->Ticket->saveAll($aTickets);
				
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}*/

	function winner($id) {

		// TODO: Check admin role

		$result = $this->Raffle->Ticket->find(array('raffle_id' => $id), "id", array('rand()'));
		$winner = $result["Ticket"]["id"];

		$this->Session->setFlash('And the winner is... '.$winner);
	}
}
?>
