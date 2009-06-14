<?php echo $form->create('Subscriber', array('action' => 'add')); ?>
<?php
	echo $form->input('name', array( 'label' => 'Tu Nombre'));
	echo $form->input('mail', array( 'label' => 'E-mail'));
?>
<?php echo $form->end('Enviar'); ?>
