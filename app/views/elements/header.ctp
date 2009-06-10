<?php /*
<div id='header' class='clearfix'>
	<form id="SearchForm" method="post" action="<?php echo $html->url('/search') ?>">
		<div class="input text">
			<input class="watermark" name="data[Search][query]" title="Search Rifalia" value="" id="SearchQuery" type="text">
			<input id="searchButton" value="Search" type="submit">
		</div>
	</form>
	<h1><?php echo $html->link('Rifalia', '/'); ?></h1>
	<p class="tagline">Tagline</p>
	<div id='navcontainer'><?php
$menu->settings(__('main', true));
$menu->add(array(
	array('title' => __('Home', true), 'url' => '/'),
	array('title' => __('Contact Us', true), 'url' => array('controller' => 'contact', 'action' => 'us'))
));
if ($session->check('Auth.User') && empty($isEmail)) {
	if ($session->check('Auth.User.is_admin')) {
		$menu->add(array(
			array('title' => __('Admin', true), 'url' => '/admin'),
		));
	}
	$menu->add(array(
		array('title' => __('Your Profile', true), 'url' => array('controller' => 'users', 'action' => 'profile')),
		array('title' => __('Logout', true), 'url' => array('controller' => 'users', 'action' => 'logout')),
        // Se han puesto hardcoded los nombres en castellano, para futuras implementaciones es necesario hacerlo con el motor de idiomas del cake.
        array('title' => __('Cesta', true), 'url' => array('controller' => 'users', 'action' => 'ver_mi_cesta')),
	));
} else {
	$menu->add(array(
		array('title' => __('Register', true), 'url' => array('controller' => 'users', 'action' => 'register')),
		array('title' => __('Login', true), 'url' => array('controller' => 'users', 'action' => 'login'), 'htmlAttributes' => array('class' => 'login')),
	));
}
echo $menu->display();
	?></div>
</div>

*/ ?>

		<div id="cabecera">

		<div id="usuarioaccion">
		<?php echo $html->link('Registrarte', array('controller' => 'users', 'action' => 'register')) ?>
        </div>

            <h1><a href="/" title="Rifalia" rel="home"><span>Rifalia</span></a></h1>
			<p class="tagline">Te lo mereces</p>

		</div><!-- Fin de la cabecera -->

		<div id="menu">
			<form id="search" method="get" action="<?php echo $html->url('/search') ?>">
		        <div class="input text">
			        <input name="data[Search][query]" title="Search Rifalia" value="" id="searchtext" type="text" size="30" tabindex="1" />
			        <input id="searchButton" value="Buscar" type="submit" tabindex="2" />
		        </div>
	        </form>
        <?php
        $menu->settings(__('main', true));
        $menu->add(array(
	        array('title' => __('Home', true), 'url' => '/'),
	        array('title' => __('Contact Us', true), 'url' => array('controller' => 'contact', 'action' => 'us'))
        ));
        if ($session->check('Auth.User') && empty($isEmail)) {
	        if ($session->check('Auth.User.is_admin')) {
		        $menu->add(array(
			        array('title' => __('Admin', true), 'url' => '/admin'),
		        ));
	        }
	        $menu->add(array(
		        array('title' => __('Your Profile', true), 'url' => array('controller' => 'users', 'action' => 'profile')),
		        array('title' => __('Logout', true), 'url' => array('controller' => 'users', 'action' => 'logout')),
                array('title' => __('Cesta', true), 'url' => array('controller' => 'users', 'action' => 'ver_mi_cesta')),

            ));
        } else {
	        $menu->add(array(
		        array('title' => __('Login', true), 'url' => array('controller' => 'users', 'action' => 'login'), 'htmlAttributes' => array('class' => 'login')),
	        ));
        }
        echo $menu->display();
	        ?>
		</div><!-- Fin del menu -->