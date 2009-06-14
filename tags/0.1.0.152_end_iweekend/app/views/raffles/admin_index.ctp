<table>
<?php
$this->set('pageTitle', __('Raffles', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('available_tickets'),
	$paginator->sort('ticket_price'),
	$paginator->sort('sold_tickets'),
	$paginator->sort('closes'),
	__('Parent', true),
	$paginator->sort('is_published'),
	$paginator->sort('published'),
	$paginator->sort('is_assigned'),
	$paginator->sort('assigned'),
	$paginator->sort('Winner.login'),
	$paginator->sort('winner_code'),
	$paginator->sort('is_cancelled'),
	$paginator->sort('cancelled'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Raffle['id'], array('action' => 'view', $Raffle['id'])),
			$Raffle['available_tickets'],
			$Raffle['ticket_price'],
			$Raffle['sold_tickets'],
			$Raffle['closes'],
			!empty($Raffle['parent_id'])?$parents[$Raffle['parent_id']]:'',
			$Raffle['is_published'],
			$Raffle['published'],
			$Raffle['is_assigned'],
			$Raffle['assigned'],
			$Winner?$Winner['login']:'',
			$Raffle['winner_code'],
			$Raffle['is_cancelled'],
			$Raffle['cancelled'],
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
	array('title' => __('New Raffle', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Raffles', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Raffles', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));