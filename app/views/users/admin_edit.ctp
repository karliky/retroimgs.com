<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New User', true));
} else {
	$this->set('pageTitle', __('Edit User', true));
}
?>
<div class="form-container">
<?php
echo $form->create();
echo $form->inputs(array(
	'legend' => false,
	'id',
	'group',
	'username',
	'first_name',
	'last_name',
	'email',
	'email_verified',
));
echo $form->end(__('Submit', true));
?></div>