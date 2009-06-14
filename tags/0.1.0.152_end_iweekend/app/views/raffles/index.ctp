<table>
<?php
$this->set('pageTitle', __('Raffles', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('Precio'),
	$paginator->sort('Tickets totales'),
	$paginator->sort('Quedan'),
	$paginator->sort('closes'),
	$paginator->sort('Ganador'),
	$paginator->sort('Ticket ganador'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Raffle['id'], array('action' => 'view', $Raffle['id'])),
			$Raffle['ticket_price'],
			$Raffle['available_tickets'],
			$Raffle['available_tickets'] - $Raffle['sold_tickets'],
			$Raffle['closes'],
			!empty($Raffle['winner_code'])?$Winner['login']:'Rifa abierta',
			$Raffle['winner_code'],
		),
	);
	$class = $i%2?'even':'odd';
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $this->element('paging');
$menu->settings(__('Opciones', true), array());
$menu->add(array(
	array('title' => __('Nueva Rifa', true), 'url' => array('action' => 'add')),
//	array('title' => __('Add Many Raffles', true), 'url' => array('action' => 'multi_add')),
//	array('title' => __('Edit These Raffles', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));
