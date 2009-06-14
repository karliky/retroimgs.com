<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New User', true));
} else {
	$this->set('pageTitle', __('Edit User', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'login',
	'email',
	'address',
	'phone',
	'balance',
	'is_admin',
	'is_enabled',
	'is_email_verified',
));
echo $form->end(__('Submit', true));
?></div>