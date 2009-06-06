<?php
$this->set('pageTitle', __('Products', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Product Id', true),
	__d('fieldnames', 'Product Tittle', true),
	__d('fieldnames', 'Product Short Description', true),
	__d('fieldnames', 'Product Long Description', true),
	__d('fieldnames', 'Product Lat', true),
	__d('fieldnames', 'Product Long', true),
	__d('fieldnames', 'Product Zoom', true),
	__d('fieldnames', 'Product Price', true),
	__d('fieldnames', 'Product Order', true),
	__d('fieldnames', 'Product Video', true),
	__d('fieldnames', 'Product Video Type', true),
	__d('fieldnames', 'Product Image', true),
	__d('fieldnames', 'Product Acept', true),
	__d('fieldnames', 'Product Acepted Date', true),
	__d('fieldnames', 'Product Categories', true),
	__d('fieldnames', 'Product Raffles', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Product'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Product['id'] . $form->input($i . '.Product.id', array('type' => 'hidden')),
			$form->input($i . '.Product.tittle', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.short_description', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.long_description', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.lat', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.long', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.zoom', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.price', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.order', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.video', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.video_type', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.image', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.acept', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.acepted_date', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.categories_id', array('div' => false, 'label' => false)),
			$form->input($i . '.Product.raffles_id', array('div' => false, 'label' => false)),
		),
	);
	$class = $i%2?'even':'odd';
	if ($this->action === 'admin_multi_add') {
		$class .= ' clone';
	}
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $form->end(__('Submit', true));