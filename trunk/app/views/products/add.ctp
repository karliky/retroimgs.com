<?php
$this->set('pageTitle', __('New Product', true));
?>
<div class="form-container">
<?php
echo $form->create(null, array('type' => 'file')); // Default to enable file uploads
echo $form->inputs(array(
	'legend' => false,
	'id',
	'categories_id' => array('options' => array('Temp', 'List', 'Of', 'Options'), 'empty' => true),
	'tittle' => array('title' => __('Write the name of your product here', true)),
	'short_description',
	'long_description' => array('type' => 'textarea'),
	'lat',
	'long',
	'zoom',
	'price',
	'order',
	'video',
	'video_type',
	'image' => array('type' => 'file'),
	'acept',
	'acepted_date' => array('type' => 'date'),
));
echo $form->end(__('Submit', true));
?></div>
