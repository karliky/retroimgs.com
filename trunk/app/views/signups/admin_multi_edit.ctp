<?php
$this->set('pageTitle', __('Signups', true));
?>
<?php echo $form->create(null, array('url' => $this->passedArgs)); ?>
<table>
<?php
$th = array(
	__d('fieldnames', 'Signup Id', true),
	__d('fieldnames', 'Signup Email', true),
);
echo $html->tableHeaders($th);
foreach ($data as $i => $row) {
	if (!is_array($row) || !isset($row['Signup'])) {
		continue;
	}
	extract($row);
	$tr = array(
		array(
			$Signup['id'] . $form->input($i . '.Signup.id', array('type' => 'hidden')),
			$form->input($i . '.Signup.email', array('div' => false, 'label' => false)),
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