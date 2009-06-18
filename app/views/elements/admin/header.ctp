<?php /* SVN FILE: $Id$ */ ?>
<div id='header' class="clearfix">
	<div id='navcontainer'>	<?php
		$menu->settings(__('main', true), array('activeMode' => 'controller'));
		if (trim($this->params['url']['url'], '/') == 'admin') {
			$menu->add(array('title' => __('Public', true), 'url' => '/'));
		} else {
			$menu->add(array('title' => __('Admin', true), 'url' => '/admin'));
		}
		if (1==2 && Configure::read()) {
			$this->element('admin/menu/auto', array('ignore' => array(
				'Contact', 'Dev', 'Emails', 'Enums', 'Lookup', 'Media', 'Pages', 'Settings'
			)));
		} else {
			$menu->add(array(
				array(
					'title' => __('Raffles', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'raffles', 'action' => 'index')
				),
				array(
					'title' => __('Tickets', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'tickets', 'action' => 'index')
				),
				array(
					'title' => __('Products', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'products', 'action' => 'index')
				),
				array(
					'title' => __('Categories', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'categories', 'action' => 'index')
				),
				array(
					'title' => __('Subscriptions', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'subscriptions', 'action' => 'index')
				),
				array(
					'title' => __('Sign ups', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'signups', 'action' => 'index')
				),
				array(
					'title' => __('Transactions', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'transactions', 'action' => 'index')
				),
				array(
					'title' => __('Users', true),
					'url' => array('prefix' => null, 'plugin' => null, 'controller' => 'users', 'action' => 'index')
				),
			));
		}
		$menu->add(array(
			'title' => __('Logout', true),
			'url' => array('admin' => false, 'prefix' => null, 'plugin' => null, 'controller' => 'users', 'action' => 'logout')
		));
		echo $menu->display();
	?></div>
</div>