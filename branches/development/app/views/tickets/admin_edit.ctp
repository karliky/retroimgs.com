<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Ticket', true));
} else {
	$this->set('pageTitle', __('Edit Ticket', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'code',
	'user_id' => array('empty' => true),
	'raffle_id' => array('empty' => true),
	'transaction_id' => array('empty' => true),
));
echo $form->end(__('Submit', true));
?></div>