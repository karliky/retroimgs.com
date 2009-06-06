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
	'tittle',
	'short_description',
	'long_description',
	'lat',
	'long',
	'zoom',
	'price',
	'order',
	'video',
	'video_type',
	'image',
	'acept',
	'acepted_date',
	'categories_id',
	'raffles_id',
));
echo $form->end(__('Submit', true));
?></div>