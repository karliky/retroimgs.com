<?php
extract($data);
$this->set('pageTitle', $Category['name']);
?>
<table>
<?php
$tr = array(
	array(__d('field_names', 'Category Id', true), $Category['id']),
	array(__d('field_names', 'Category Parent Id', true), $Category['parent_id']),
	array(__d('field_names', 'Category Name', true), $Category['name']),
	array(__d('field_names', 'Category Description', true), $Category['description']),
);
echo $html->tableCells($tr);
?>
</table>
<?php
$menu->settings(__('This Category', true));
$menu->add(array(
	array('title' => __('Edit', true), 'url' => array('action' => 'edit', $Category['id'])),
	array('title' => __('Delete', true), 'url' => array('action' => 'delete', $Category['id']))
));
