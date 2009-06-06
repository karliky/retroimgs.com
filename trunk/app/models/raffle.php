<?
class Raffle extends AppModel {
	var $hasMany = Array('Ticket');

	function afterSave($created) {
		if ($created) {
			if (!empty($this->data)) {
				// Add tickets
				$aTickets = Array();
				for($i=0; $i<$this->data["Raffle"]["tickets_count"]; $i++) {
					$aTickets[$i] =Array("number" => $i, "raffle_id" => $this->id);
				}
				$this->Ticket->saveAll($aTickets);
			}
		}
	}
}

?>
