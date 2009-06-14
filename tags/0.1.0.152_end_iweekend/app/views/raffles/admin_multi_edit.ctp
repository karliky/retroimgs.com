<?php
$this->set('pageTitle', __('Raffles', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Raffle Id', true),
	__d('fieldnames', 'Raffle Available Tickets', true),
	__d('fieldnames', 'Raffle Ticket Price', true),
	__d('fieldnames', 'Raffle Sold Tickets', true),
	__d('fieldnames', 'Raffle Closes', true),
	__d('fieldnames', 'Raffle Parent', true),
	__d('fieldnames', 'Raffle Is Published', true),
	__d('fieldnames', 'Raffle Published', true),
	__d('fieldnames', 'Raffle Is Assigned', true),
	__d('fieldnames', 'Raffle Assigned', true),
	__d('fieldnames', 'Raffle Winner', true),
	__d('fieldnames', 'Raffle Winner Code', true),
	__d('fieldnames', 'Raffle Is Cancelled', true),
	__d('fieldnames', 'Raffle Cancelled', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Raffle'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Raffle['id'] . $form->input($i . '.Raffle.id', array('type' => 'hidden')),
			$form->input($i . '.Raffle.available_tickets', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.ticket_price', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.sold_tickets', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.closes', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.parent_id', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.is_published', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.published', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.is_assigned', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.assigned', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.winner_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Raffle.winner_code', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.is_cancelled', array('div' => false, 'label' => false)),
			$form->input($i . '.Raffle.cancelled', array('div' => false, 'label' => false)),
		),
	);
	$class = $i%2?'even':'odd';
	if ($this->action === 'admin_multi_add') {
		$class .= ' clone';
	}
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $form->end(__('Submit', true));