<?php
class RafflesController extends AppController {
	var $scaffold = array('index', 'add', 'edit', 'delete');

	var $name = 'Raffles';

	//function index() {
		//$this->set('raffles', $this->Raffle->find('all'));
	//}

	function add() {
		
		// TODO: check admin role

		if (!empty($this->data)) {
			if ($this->Raffle->save($this->data)) {
				
				// Add tickets
				$aTickets = Array();
				for($i=0; $i<$this->data["Raffle"]["tickets_count"]; $i++) {
					$aTickets[$i] =Array("number" => $i, "raffle" => $this->Raffle->id);
				}
				$this->Raffle->Ticket->saveAll($aTickets);
//print_r($this->Raffle->Ticket);
//print_r($this->data);
//echo "    $i<br/>";
//echo $this->Raffle->data["tickets_count"];
//die();
				
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
?>
