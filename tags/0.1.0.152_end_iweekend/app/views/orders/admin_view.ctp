<?php
extract($data);
$this->set('pageTitle', $Order['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Order Id', true), $Order['id']),
	array(__d('field_names', 'Order User', true), $User?$User['login']:''),
	array(__d('field_names', 'Order Amount', true), $Order['amount']),
	array(__d('field_names', 'Order Transaction', true), $Transaction?$Transaction['id']:''),
	array(__d('field_names', 'Order Ticket', true), $Ticket?$Ticket['id']:''),
	array(__d('field_names', 'Order Description', true), $Order['description']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Order', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Order['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Order['id']))
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