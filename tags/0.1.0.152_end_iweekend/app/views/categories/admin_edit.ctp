<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Category', true));
} else {
	$this->set('pageTitle', __('Edit Category', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'name',
	'description',
));
echo $form->end(__('Submit', true));
?></div>