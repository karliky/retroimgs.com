<table>
<?php
$this->set('pageTitle', __('Products', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('tittle'),
	$paginator->sort('short_description'),
	$paginator->sort('long_description'),
	$paginator->sort('lat'),
	$paginator->sort('long'),
	$paginator->sort('zoom'),
	$paginator->sort('price'),
	$paginator->sort('order'),
	$paginator->sort('video'),
	$paginator->sort('video_type'),
	$paginator->sort('image'),
	$paginator->sort('acept'),
	$paginator->sort('acepted_date'),
	$paginator->sort('categories_id'),
	$paginator->sort('raffles_id'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Product['id'], array('action' => 'view', $Product['id'])),
			$Product['tittle'],
			$Product['short_description'],
			$Product['long_description'],
			$Product['lat'],
			$Product['long'],
			$Product['zoom'],
			$Product['price'],
			$Product['order'],
			$Product['video'],
			$Product['video_type'],
			$Product['image'],
			$Product['acept'],
			$Product['acepted_date'],
			$Product['categories_id'],
			$Product['raffles_id'],
		),
	);
	$class = $i%2?'even':'odd';
	echo $html->tableCells($tr, compact('class'), compact('class'));
}
?>
</table>
<?php
echo $this->element('paging');
$menu->settings(__('Options', true), array());
$menu->add(array(
	array('title' => __('New Product', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Products', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Products', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));