<?php
$this->set('pageTitle', __('Transactions', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Transaction Id', true),
	__d('fieldnames', 'Transaction Payment Gateway', true),
	__d('fieldnames', 'Transaction User', true),
	__d('fieldnames', 'Transaction Transaction Type', true),
	__d('fieldnames', 'Transaction Amount', true),
	__d('fieldnames', 'Transaction Authorisation Code', true),
	__d('fieldnames', 'Transaction Payment Requested', true),
	__d('fieldnames', 'Transaction Payment Response', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Transaction'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Transaction['id'] . $form->input($i . '.Transaction.id', array('type' => 'hidden')),
			$form->input($i . '.Transaction.payment_gateway_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Transaction.user_id', array('div' => false, 'label' => false, 'empty' => true)),
			$form->input($i . '.Transaction.transaction_type', array('div' => false, 'label' => false)),
			$form->input($i . '.Transaction.amount', array('div' => false, 'label' => false)),
			$form->input($i . '.Transaction.authorisation_code', array('div' => false, 'label' => false)),
			$form->input($i . '.Transaction.payment_requested', array('div' => false, 'label' => false)),
			$form->input($i . '.Transaction.payment_response', array('div' => false, 'label' => false)),
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