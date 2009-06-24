<table>
<?php
$this->set('pageTitle', __('Orders', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('User.username'),
	$paginator->sort('amount'),
	$paginator->sort('Transaction.id'),
	$paginator->sort('Ticket.id'),
	$paginator->sort('description'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Order['id'], array('action' => 'view', $Order['id'])),
			$User?$User['username']:'',
			$Order['amount'],
			$Transaction?$Transaction['id']:'',
			$Ticket?$Ticket['id']:'',
			$Order['description'],
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
	array('title' => __('New Order', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Orders', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Orders', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));