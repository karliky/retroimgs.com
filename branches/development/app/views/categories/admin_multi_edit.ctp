<?php
$this->set('pageTitle', __('Categories', true));
echo $form->create();
?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Category Id', true),
	__d('fieldnames', 'Category Parent', true),
	__d('fieldnames', 'Category Name', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Category'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Category['id'] . $form->input($i . '.Category.id', array('type' => 'hidden')),
			$form->input($i . '.Category.parent_id', array('div' => false, 'label' => false, 'empty' => true, 'class' => 'lookup')),
			$form->input($i . '.Category.name', array('div' => false, 'label' => false)),
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