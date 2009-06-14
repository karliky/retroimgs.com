<?php /* SVN FILE: $Id$ */ ?>
<div id="forgotten_password" class="container form">
<h2><?php echo __('forgotten password', true) ?>?</h2>
<p><?php __('If you\'ve forgotten your password you can reset it by submitting the form below') ?></p>
<p><?php __("We'll send you an email that you must read to proceed, this helps to confirm that it's really you requesting to change your password.");
echo __('All you need to do is check the mail - click the link and enter a new password to regain access to your account.') ?></p>
<?php
echo $form->create(null, array('class'=>'cmxform','action' => 'forgotten_password'));
if ($authFields['username'] == 'email') {
	echo $form->input('email');
} else {
	echo $form->input('email', array('label' => __('email or username', true)));
}
echo '<p>'.$form->submit('Enviar Contraseña',array('class'=>'submit',"div"=>false)).'</p>';
echo $form->end();
?>
</div>