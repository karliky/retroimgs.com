<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Category', true));
} else {
	$this->set('pageTitle', __('Edit Category', true));
}
?>
<div class="form-container">
<?php
echo $form->create();
echo $form->inputs(array(
	'legend' => false,
	'id',
	'parent_id' => array('empty' => true),
	'name',
	'description',
));
echo $form->end(__('Submit', true));
?></div>