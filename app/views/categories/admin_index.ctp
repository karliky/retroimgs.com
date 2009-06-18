<?php
$this->set('pageTitle', __('Categories', true));
$this->set('displayField', 'name');
echo $tree->generate($data, array ('element' => 'admin/tree_node', 'class' => 'tree'));
if (isset($skipMenu)) {
	return;
}
$menu->settings(__('Options', true));
$menu->add(array(
	array('title' => __('New Category', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Categories', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Categories', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));