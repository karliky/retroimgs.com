<?php
extract($data);
$this->set('pageTitle', $Transaction['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Transaction Id', true), $Transaction['id']),
	array(__d('field_names', 'Transaction Payment Gateway', true), $PaymentGateway?$PaymentGateway['name']:''),
	array(__d('field_names', 'Transaction User', true), $User?$User['username']:''),
	array(__d('field_names', 'Transaction Transaction Type', true), $Transaction['transaction_type']),
	array(__d('field_names', 'Transaction Description', true), $Transaction['description']),
	array(__d('field_names', 'Transaction Amount', true), $Transaction['amount']),
	array(__d('field_names', 'Transaction Connection Details', true), $Transaction['connection_details']),
	array(__d('field_names', 'Transaction Authorisation Code', true), $Transaction['authorisation_code']),
	array(__d('field_names', 'Transaction Payment Requested', true), $Transaction['payment_requested']),
	array(__d('field_names', 'Transaction Payment Response', true), $Transaction['payment_response']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Transaction', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Transaction['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Transaction['id']))
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