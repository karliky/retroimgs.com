<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Membership', true));
} else {
	$this->set('pageTitle', __('Edit Membership', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'user_id' => array('empty' => true),
	'organization_id' => array('empty' => true),
	'is_admin',
	'admin_priority',
	'is_contact',
	'contact_priority',
));
echo $form->end(__('Submit', true));
?></div>