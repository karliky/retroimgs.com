<?php
extract($data);
$this->set('pageTitle', $User['username']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'User Id', true), $User['id']),
	array(__d('field_names', 'User Username', true), $User['username']),
	array(__d('field_names', 'User Email', true), $User['email']),
	array(__d('field_names', 'User Group', true), $User['group']),
	array(__d('field_names', 'User Email Verified', true), $User['email_verified']),
	array(__d('field_names', 'User First Name', true), $User['first_name']),
	array(__d('field_names', 'User Last Name', true), $User['last_name']),
	array(__d('field_names', 'User Pic', true), $User['pic']?$html->image($User['versions']['thumb']):''),
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