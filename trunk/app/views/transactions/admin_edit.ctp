<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Transaction', true));
} else {
	$this->set('pageTitle', __('Edit Transaction', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'payment_gateway_id' => array('empty' => true),
	'user_id' => array('empty' => true),
	'transaction_type',
	'description',
	'amount',
	'connection_details',
	'authorisation_code',
	'payment_requested',
	'payment_response',
));
echo $form->end(__('Submit', true));
?></div>