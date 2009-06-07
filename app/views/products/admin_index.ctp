<table>
<?php
$this->set('pageTitle', __('Products', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('name'),
	$paginator->sort('price'),
	$paginator->sort('category_id'),
	$paginator->sort('provider_id'),
	$paginator->sort('commission')

);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {

	extract($row);
	$tr = array(
		array(
			$html->link($Product['id'], array('action' => 'admin_edit', $Product['id'])),
			$html->link($Product['name'], array('action' => 'admin_edit', $Product['id'])),
			$Product['price'].'&euro;',
			$Category['name'],
			$Provider['name'],
			$Product['commission'].'%',
			$html->link("Borrar", array('action' => 'delete', $Product['id'])),
			$html->link('Crear Rifa', '/raffles/add/'.$Product['id'], array('class'=>'button')),
		),
	);
echo
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