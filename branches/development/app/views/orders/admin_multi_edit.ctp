<?php
$this->set('pageTitle', __('Orders', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Order Id', true),
	__d('fieldnames', 'Order User', true),
	__d('fieldnames', 'Order Amount', true),
	__d('fieldnames', 'Order Transaction', true),
	__d('fieldnames', 'Order Ticket', true),
	__d('fieldnames', 'Order Description', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Order'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Order['id'] . $form->input($i . '.Order.id', array('type' => 'hidden')),
			$form->input($i . '.Order.user_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Order.amount', array('div' => false, 'label' => false)),
			$form->input($i . '.Order.transaction_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Order.ticket_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Order.description', array('div' => false, 'label' => false)),
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