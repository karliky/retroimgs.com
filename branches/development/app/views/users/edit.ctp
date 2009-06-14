<?php /* SVN FILE: $Id$ */ ?>
<div class="container form">
<?php
$action = in_array($this->action, array('add', 'admin_add'))?'Add':'Edit';
$action = Inflector::humanize($action);
$profilePic = '';
if (!empty($data['User']['pic'])) {
	$profilePic = $this->element('thumb', array('data' => $data['User'], 'size' => 'thumb'));
}
echo $form->create(null, array('type' => 'file', 'class'=>'cmxform'));
?>
<fieldset>
<legend>Introduce los datos personales</legend>
	<?php
	echo '<p>'.$form->input('login',array('div' => false)).'</p>';
	echo '<p>'.$form->input('email',array('div' => false)).'</p>';
	echo '<p>'.$form->input('password',array('div' => false)).'</p>';
	echo '<p>'.$form->input('address',array('div' => false)).'</p>';
	echo '<p>'.$form->input('phone',array('div' => false)).'</p>';
	echo '<p>'.$form->input('balance',array('div' => false)).'</p>';
	echo '<p>'.$form->submit('Enviar',array('class'=>'submit',"div"=>false)).'</p>';
	?>
</fieldset>
<?php
echo $form->end();
echo $this->element('editor', array('process' => 'div#content textarea'));
?></div>