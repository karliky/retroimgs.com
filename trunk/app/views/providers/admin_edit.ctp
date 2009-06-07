<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Provider', true));
} else {
	$this->set('pageTitle', __('Edit Provider', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'name',
	'contact_person',
	'email',
	'phone',
	'balance',
	'default_commission',
));
echo $form->end(__('Submit', true));
?></div>