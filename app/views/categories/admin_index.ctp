<table>
<?php
$this->set('pageTitle', __('Categories', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('name'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($Category['id'], array('action' => 'view', $Category['id'])),
			$Category['name'],
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
	array('title' => __('New Category', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Categories', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Categories', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));