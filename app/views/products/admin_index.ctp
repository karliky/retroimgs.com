<table>
<?php
$this->set('pageTitle', __('Products', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('Provider.name'),
	$paginator->sort('commission'),
	$paginator->sort('Category.name'),
	$paginator->sort('Raffle.id'),
	$paginator->sort('name'),
	$paginator->sort('short_description'),
	$paginator->sort('price'),
	$paginator->sort('video_url'),
	$paginator->sort('is_on_raffle'),
	$paginator->sort('is_approved'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Product['id'], array('action' => 'view', $Product['id'])),
			$Provider?$Provider['name']:'',
			$Product['commission'],
			$Category?$Category['name']:'',
			$Raffle?$Raffle['id']:'',
			$Product['name'],
			$Product['short_description'],
			$Product['price'],
			$Product['video_url'],
			$Product['is_on_raffle'],
			$Product['is_approved'],
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