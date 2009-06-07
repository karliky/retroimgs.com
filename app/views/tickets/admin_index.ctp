<table>
<?php
$this->set('pageTitle', __('Tickets', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('code'),
	$paginator->sort('User.login'),
	$paginator->sort('Raffle.id'),
	$paginator->sort('Transaction.id'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Ticket['id'], array('action' => 'view', $Ticket['id'])),
			$Ticket['code'],
			$User?$User['login']:'',
			$Raffle?$Raffle['id']:'',
			$Transaction?$Transaction['id']:'',
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
	array('title' => __('New Ticket', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Tickets', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Tickets', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));