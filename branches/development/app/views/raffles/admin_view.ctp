<?php
extract($data);
$this->set('pageTitle', $Raffle['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Raffle Id', true), $Raffle['id']),
	array(__d('field_names', 'Raffle Available Tickets', true), $Raffle['available_tickets']),
	array(__d('field_names', 'Raffle Ticket Price', true), $Raffle['ticket_price']),
	array(__d('field_names', 'Raffle Sold Tickets', true), $Raffle['sold_tickets']),
	array(__d('field_names', 'Raffle Closes', true), $Raffle['closes']),
	array(__d('field_names', 'Raffle Parent Id', true), $Raffle['parent_id']),
	array(__d('field_names', 'Raffle Is Published', true), $Raffle['is_published']),
	array(__d('field_names', 'Raffle Published', true), $Raffle['published']),
	array(__d('field_names', 'Raffle Is Assigned', true), $Raffle['is_assigned']),
	array(__d('field_names', 'Raffle Assigned', true), $Raffle['assigned']),
	array(__d('field_names', 'Raffle Winner', true), $Winner?$Winner['username']:''),
	array(__d('field_names', 'Raffle Winner Code', true), $Raffle['winner_code']),
	array(__d('field_names', 'Raffle Is Cancelled', true), $Raffle['is_cancelled']),
	array(__d('field_names', 'Raffle Cancelled', true), $Raffle['cancelled']),
	array(__d('field_names', 'Raffle Product', true), $Product?$Product['name']:''),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Raffle', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Raffle['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Raffle['id']))
));
$menu->settings(__('View', true));
foreach ($goto as $array) {
	extract($array);
	echo "if (!empty($title)) {\r\n";
	echo "\t\$menu->add(array(\r\n";
	echo "\t\t'title' => $title, 'url' => array('controller' => '$controller', 'action' => 'view', $id),\r\n";
	echo "\t));\r\n";
	echo "}\r\n";
}