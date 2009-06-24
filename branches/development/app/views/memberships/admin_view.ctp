<?php
extract($data);
$this->set('pageTitle', $Membership['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Membership Id', true), $Membership['id']),
	array(__d('field_names', 'Membership User', true), $User?$User['username']:''),
	array(__d('field_names', 'Membership Organization', true), $Organization?$Organization['name']:''),
	array(__d('field_names', 'Membership Is Admin', true), $Membership['is_admin']),
	array(__d('field_names', 'Membership Admin Priority', true), $Membership['admin_priority']),
	array(__d('field_names', 'Membership Is Contact', true), $Membership['is_contact']),
	array(__d('field_names', 'Membership Contact Priority', true), $Membership['contact_priority']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Membership', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Membership['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Membership['id']))
));
$menu->settings(__('View', true));
$menu->add(array(
	array('title' => __('Organization', true), 'url' => array('controller' => 'organizations', 'action' => 'view', $Organization['id'])),
	array('title' => __('User', true), 'url' => array('controller' => 'users', 'action' => 'view', $User['id'])),
	array('title' => __('All users for this organization', true), 'url' => array('action' => 'index', 'organization_id' => $Organization['id'])),
	array('title' => __('All organizations for this user', true), 'url' => array('action' => 'index', 'user_id' => $User['id'])),
));