<?php
extract($data);
$this->set('pageTitle', $User['username']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'User Id', true), $User['id']),
	array(__d('field_names', 'User Login', true), $User['username']),
	array(__d('field_names', 'User Email', true), $User['email']),
	array(__d('field_names', 'User Address', true), $User['address']),
	array(__d('field_names', 'User Phone', true), $User['phone']),
	array(__d('field_names', 'User Balance', true), $User['balance']),
	array(__d('field_names', 'User Is Admin', true), $User['is_admin']),
	array(__d('field_names', 'User Is Enabled', true), $User['is_enabled']),
	array(__d('field_names', 'User Is Email Verified', true), $User['is_email_verified']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This User', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $User['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $User['id']))
));