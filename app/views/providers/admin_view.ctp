<?php
extract($data);
$this->set('pageTitle', $Provider['name']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Provider Id', true), $Provider['id']),
	array(__d('field_names', 'Provider Name', true), $Provider['name']),
	array(__d('field_names', 'Provider Contact Person', true), $Provider['contact_person']),
	array(__d('field_names', 'Provider Email', true), $Provider['email']),
	array(__d('field_names', 'Provider Phone', true), $Provider['phone']),
	array(__d('field_names', 'Provider Balance', true), $Provider['balance']),
	array(__d('field_names', 'Provider Default Commission', true), $Provider['default_commission']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Provider', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Provider['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Provider['id']))
));
