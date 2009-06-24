<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Raffle', true));
} else {
	$this->set('pageTitle', __('Edit Raffle', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('class'=>'cmxform'));
echo $form->inputs(array(
	'legend' => false,
	'id',
	'product_id' => array('class' => 'lookup', 'empty' => true),
	'available_tickets',
	'ticket_price',
	'closes',
	'is_published',
	'published',
	'is_cancelled',
	'cancelled',
));
echo $form->end(__('Submit', true));
?></div>