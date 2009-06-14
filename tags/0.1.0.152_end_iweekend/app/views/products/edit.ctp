<?php
$this->set('pageTitle', __('Edit Product', true));
?>
<div class="form-container">
<?php
echo $form->create(null, array('class'=>'cmxform', 'type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => "Editar Producto",
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