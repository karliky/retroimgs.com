<table>
<?php
$this->set('pageTitle', __('Users', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	$paginator->sort('login'),
	$paginator->sort('email'),
	$paginator->sort('address'),
	$paginator->sort('phone'),
	$paginator->sort('balance'),
	$paginator->sort('is_admin'),
	$paginator->sort('is_enabled'),
	$paginator->sort('is_email_verified'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($User['id'], array('action' => 'view', $User['id'])),
			$User['login'],
			$User['email'],
			$User['address'],
			$User['phone'],
			$User['balance'],
			$User['is_admin'],
			$User['is_enabled'],
			$User['is_email_verified'],
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
	array('title' => __('New User', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Users', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Users', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));