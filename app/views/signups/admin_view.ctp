<?php
extract($data);
$this->set('pageTitle', $Signup['id']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Signup Id', true), $Signup['id']),
	array(__d('field_names', 'Signup Email', true), $Signup['email']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Signup', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Signup['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Signup['id']))
));
