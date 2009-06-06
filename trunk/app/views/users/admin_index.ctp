<?php /* SVN FILE: $Id$ */ ?>
<table>
<?php
$this->set('pageTitle', __('Users', true));
$paginator->options(array('url' => $this->passedArgs));
$th = array(
	$paginator->sort('id'),
	__('Pic', true),
	$paginator->sort(__('Name', true), 'last_name'),
	$paginator->sort('username'),
	$paginator->sort('email'),
	$paginator->sort('group'),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	extract($row);
	$tr = array(
		array(
			$html->link($User['id'], array('action' => 'view', $User['id'])),
			$User['pic']?$html->image($User['versions']['thumb']):'',
			$displayNames[$User['id']],
			$User['username'],
			$User['email'],
			$User['group'],
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