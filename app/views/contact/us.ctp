<?php /* SVN FILE: $Id: us.ctp 971 2009-04-27 15:13:51Z ad7six $ */
echo $form->create('Contact', array('class'=>'cmxform', 'url' => Router::normalize($this->here)));
$cats = array(
	':)' => ':) Compliment',
	':\'(' => ':\'( Complaint',
	'?' => '? Question',
	'$' => '$ Quote',
	'!' => '! Problem',

);

echo $form->inputs(array(
	'legend' => 'Mail me',
	'category' => array('options' => $cats),
	'subject' => array(),
	'body' => array('cols' => 60, 'type'=>'textarea'),
	'from' => array('title' => 'Please enter a contact email address', 'default' => $session->read('Auth.User.email')),
	'url'
));
echo "<p>".$form->submit("Enviar",array("class"=>"submit","div"=>false))."</p>";
echo $form->end();
?>