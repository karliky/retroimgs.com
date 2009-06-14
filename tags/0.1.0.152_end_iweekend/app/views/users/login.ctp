<?php /* SVN FILE: $Id: login.ctp 968 2009-04-26 20:17:37Z ad7six $ */ ?>
<div class="container form">
<?php
if (empty($this->params['isAjax'])) {
	$legend = __('Login', true);
} else {
	$legend = false;
}
echo $form->create(null, array('action' => 'login', 'url' => $this->passedArgs, 'class'=>'cmxform'));
?>
<fieldset>
<legend>Introduce los datos personales</legend>
<?php


$after = '<p>' . $html->link(__('forgotten password', true), array('action' => 'forgotten_password')) .
	' ' . $html->link(__('sign up', true), array('action' => 'register')) .
	'</p>';

echo "".$form->input('login',array('div' => false))."";
echo "".$form->input('password',array('div' => false))."";
echo "".$form->input('remember_me',array('div' => false,'label'=>"recordarme",'type' => 'checkbox'))."";

/*echo $form->input('login',array('div' => false));
echo $form->input('login',array('div' => false));
echo $form->inputs(array(
	'legend' => $legend,
	$authFields['username'],
	$authFields['password'] => array('value' => '', 'after' => $after),
	'remember_me' => array('label' => __('remember_me', true),
		'type' => 'checkbox', 'div'=>false,'after' => '<p>' . __('for 2 weeks unless I sign out.', true) . '</p>'),
));
*/
echo ''.$form->submit('Enviar',array('class'=>'submit',"div"=>false)).'';


echo '<p>' . $html->link(__('forgotten password', true),
			array('action' => 'forgotten_password')) .
	' ' . $html->link(__('sign up', true), array('action' => 'register')) .
	'</p>';
?>


</fieldset>
<?php
echo $form->end();
?></div>