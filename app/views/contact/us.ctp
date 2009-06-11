<?php /* SVN FILE: $Id: us.ctp 971 2009-04-27 15:13:51Z ad7six $ */
echo $form->create('Contact', array('class'=>'cmxform', 'url' => Router::normalize($this->here)));
$cats = array(
	'?' => '? Pregunta',
);

echo $form->inputs(array(
	'legend' => '¡Hablamos!',
	'category' => array('options' => $cats),
	'subject' => array(),
	'body' => array('cols' => 60, 'type'=>'textarea'),
	'from' => array('title' => __('Please enter a contact email address', true), 'default' => $session->read('Auth.User.email')),
	'url'
));
echo "<p>".$form->submit("Enviar",array("class"=>"submit","div"=>false))."</p>";
echo $form->end();
?>