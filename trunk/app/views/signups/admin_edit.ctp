<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Signup', true));
} else {
	$this->set('pageTitle', __('Edit Signup', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'email',
));
echo $form->end(__('Submit', true));
?></div>