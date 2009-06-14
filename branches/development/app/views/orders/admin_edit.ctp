<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Order', true));
} else {
	$this->set('pageTitle', __('Edit Order', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'user_id' => array('empty' => true),
	'amount',
	'transaction_id' => array('empty' => true),
	'ticket_id' => array('empty' => true),
	'description',
));
echo $form->end(__('Submit', true));
?></div>