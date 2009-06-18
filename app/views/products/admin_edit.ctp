<?php
if ($this->action === 'admin_add') {
	$this->set('pageTitle', __('New Product', true));
} else {
	$this->set('pageTitle', __('Edit Product', true));
}
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'provider_id' => array('empty' => true),
	'category_id' => array('empty' => true),
	'name',
	'short_description',
	'description',
	'price',
	'commission',
	'video_url',
	'is_on_raffle',
	'is_approved',
));
echo $form->end(__('Submit', true));
echo $this->element('product_commission_form');
?></div>