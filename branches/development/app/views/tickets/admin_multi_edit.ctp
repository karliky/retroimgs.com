<?php
$this->set('pageTitle', __('Tickets', true));
echo $form->create(); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Ticket Id', true),
	__d('fieldnames', 'Ticket Code', true),
	__d('fieldnames', 'Ticket User', true),
	__d('fieldnames', 'Ticket Raffle', true),
	__d('fieldnames', 'Ticket Transaction', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Ticket'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Ticket['id'] . $form->input($i . '.Ticket.id', array('type' => 'hidden')),
			$form->input($i . '.Ticket.code', array('div' => false, 'label' => false)),
			$form->input($i . '.Ticket.user_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Ticket.raffle_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Ticket.transaction_id', array('div' => false, 'label' => false, 'empty' => true)),
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