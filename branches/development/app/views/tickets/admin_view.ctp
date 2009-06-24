<?php
extract($data);
$this->set('pageTitle', $Ticket['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Ticket Id', true), $Ticket['id']),
	array(__d('field_names', 'Ticket Code', true), $Ticket['code']),
	array(__d('field_names', 'Ticket User', true), $User?$User['username']:''),
	array(__d('field_names', 'Ticket Raffle', true), $Raffle?$Raffle['id']:''),
	array(__d('field_names', 'Ticket Transaction', true), $Transaction?$Transaction['id']:''),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Ticket', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Ticket['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Ticket['id']))
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