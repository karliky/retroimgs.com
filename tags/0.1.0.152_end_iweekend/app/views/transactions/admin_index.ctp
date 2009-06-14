<table>
<?php
$this->set('pageTitle', __('Transactions', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('PaymentGateway.name'),
	$paginator->sort('User.login'),
	$paginator->sort('transaction_type'),
	$paginator->sort('amount'),
	$paginator->sort('authorisation_code'),
	$paginator->sort('payment_requested'),
	$paginator->sort('payment_response'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Transaction['id'], array('action' => 'view', $Transaction['id'])),
			$PaymentGateway?$PaymentGateway['name']:'',
			$User?$User['login']:'',
			$Transaction['transaction_type'],
			$Transaction['amount'],
			$Transaction['authorisation_code'],
			$Transaction['payment_requested'],
			$Transaction['payment_response'],
		),
	);
	$class = $i%2?'even':'odd';
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $this->element('paging');
$menu->settings(__('Options', true), array());
$menu->add(array(
	array('title' => __('New Transaction', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Transactions', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Transactions', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));