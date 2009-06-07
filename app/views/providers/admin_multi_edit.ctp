<?php
$this->set('pageTitle', __('Providers', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Provider Id', true),
	__d('fieldnames', 'Provider Name', true),
	__d('fieldnames', 'Provider Contact Person', true),
	__d('fieldnames', 'Provider Email', true),
	__d('fieldnames', 'Provider Phone', true),
	__d('fieldnames', 'Provider Balance', true),
	__d('fieldnames', 'Provider Default Commission', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Provider'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Provider['id'] . $form->input($i . '.Provider.id', array('type' => 'hidden')),
			$form->input($i . '.Provider.name', array('div' => false, 'label' => false)),
			$form->input($i . '.Provider.contact_person', array('div' => false, 'label' => false)),
			$form->input($i . '.Provider.email', array('div' => false, 'label' => false)),
			$form->input($i . '.Provider.phone', array('div' => false, 'label' => false)),
			$form->input($i . '.Provider.balance', array('div' => false, 'label' => false)),
			$form->input($i . '.Provider.default_commission', array('div' => false, 'label' => false)),
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