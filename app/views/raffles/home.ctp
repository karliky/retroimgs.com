<?php ?>
			<div id="contenido_iz">
				
				<ul id="contenedor_destacado">
					<li class="producto_destacado">
						<img src="./img/audi.png">
						<div class="titulo"><h2>Audi TT 2,8 140 CV</h2></div>
						<div class="descripcion">
							<p class="stock_boletos">S&oacute;lo quedan 20 boletos</p>
							<p>Antes de 1 d. 30 min. 20 sec.</p>
							<p class="precio">Tu boleto por solo <strong>1,30 €</strong></p>
							<div class="boton_reserva"><a href="#">¡Reserva ahora!</a></div>
						</div>
					</li>
				</ul>
				
				<div id="resto_productos">
					<div class="producto">
          	<h3>Siemens Dualset Inalambrico</h3>
            <img src="img/product_example.jpg" title="Siemens Dualset Inalambrico" />
            <div class="descripcion">
            	<p class="stock_boletos">S&oacute;lo quedan <br />20 boletos</p>
            	<p>Antes de <br />1 d. 30 min. 20 sec.</p>
							<p class="precio">Tu boleto por solo <strong>1,30 €</strong></p>
							<div class="boton_reserva"><a href="#">¡Reserva ahora!</a></div>
						</div>
					</div>
					<div class="producto">
          	<h3>Siemens Dualset Inalambrico</h3>
            <img src="img/product_example.jpg" title="Siemens Dualset Inalambrico" />
            <div class="descripcion">
            	<p class="stock_boletos">S&oacute;lo quedan <br />20 boletos</p>
            	<p>Antes de <br />1 d. 30 min. 20 sec.</p>
							<p class="precio">Tu boleto por solo <strong>1,30 €</strong></p>
							<div class="boton_reserva"><a href="#">¡Reserva ahora!</a></div>
						</div>
					</div>
					<div class="producto">
          	<h3>Siemens Dualset Inalambrico</h3>
            <img src="img/product_example.jpg" title="Siemens Dualset Inalambrico" />
            <div class="descripcion">
            	<p class="stock_boletos">S&oacute;lo quedan <br />20 boletos</p>
            	<p>Antes de <br />1 d. 30 min. 20 sec.</p>
							<p class="precio">Tu boleto por solo <strong>1,30 €</strong></p>
							<div class="boton_reserva"><a href="#">¡Reserva ahora!</a></div>
						</div>
					</div>
					<div class="producto">
          	<h3>Siemens Dualset Inalambrico</h3>
            <img src="img/product_example.jpg" title="Siemens Dualset Inalambrico" />
            <div class="descripcion">
            	<p class="stock_boletos">S&oacute;lo quedan <br />20 boletos</p>
            	<p>Antes de <br />1 d. 30 min. 20 sec.</p>
							<p class="precio">Tu boleto por solo <strong>1,30 €</strong></p>
							<div class="boton_reserva"><a href="#">¡Reserva ahora!</a></div>
						</div>
					</div>
				</div><!-- Fin del resto de productos -->
			
			</div><!-- Fin del contenido_iz -->
			
			<div id="contenido_der">
			
			
			           	<p class="boton-rifa-big"><a href="#" onclick="alert('En estos momentos no esta disponible');return false" title="Crea tu propia rifa">Crea tu propia rifa</a></p>
            
                <div id="siedebar-a">
                
                	<ul>
                    	<li class="sidebar-premiados"><h2><a href="http://blog.rifalia.com/category/premiados" title="Premiados Rifalia">Premiados Rifalia</a></h2>
                        	<ul>
                            	<li><a href="#" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                                <li><a href="#" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                                <li><a href="#" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                                <li><a href="#" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                                <li><a href="#" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                            </ul>
                        </li>
                        
                        
                    	<li class="sidebar-blog"><h2><a href="http://blog.rifalia.com/" title="El Blog">El Blog</a></h2>
                        	<ul>
<?php 
	
	class RssReader { 
	    var $url; 
	    var $data; 
	    
	    function RssReader ($url){ 
	        $this->url; 
	        $this->data = implode ("", file ($url)); 
	    } 
	    
	    function get_items (){ 
	        preg_match_all ("/<item .*>.*<\/item>/xsmUi", $this->data, $matches); 
	        $items = array (); 
	        foreach ($matches[0] as $match){ 
	            $items[] = new RssItem ($match); 
	        } 
	        return $items; 
	    } 
	} 
	
	class RssItem { 
	    var $title, $url, $description; 
	    
	    function RssItem ($xml){ 
	        $this->populate ($xml); 
	    } 
	    
	    function populate ($xml){ 
	        preg_match ("/<title> (.*) <\/title>/xsmUi", $xml, $matches); 
	        $this->title = $matches[1]; 
	        preg_match ("/<link> (.*) <\/link>/xsmUi", $xml, $matches); 
	        $this->url = $matches[1]; 
    } 
	    
    function get_title (){ 
        return $this->title; 
	    } 
	
	    function get_url (){ 
        return $this->url; 
	    } 
	    
	    function get_description (){ 
	        return $this->description; 
	    } 
	} 

$rss = new RssReader ("http://blog.rifalia.com/feed/"); 
	foreach ($rss->get_items () as $item){ 
		printf ('<li><a href="%s">%s</a></li>', 
		$item->get_url (), $item->get_title () ); 
	} 
?> 
                            </ul>
                        </li>
                        
                    	<li  class="sidebar-twitter"><h2><a href="http://twitter.com/rifalia" title="Canal Tweeter">Canal Tweeter</a></h2>
                        	<ul>
                            	<li><div id="twitter_div">
                                <h2 style="display: none;" >Twitter Updates</h2>
                                <ul id="twitter_update_list"></ul>
                               
                                </div>
                                <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
                                <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/rifalia.json?callback=twitterCallback2&amp;count=1"></script></li>
                            </ul>
                        </li>
                        
                    
                    </ul>
                
                </div><!-- Fin del sidebar-A -->
                
                
                
                <div id="siedebar-b">
                	<h2>Tiendas rifalia</h2>
                	<ul>
                    	<li><a href="#"><img src="img/tiendas/audi.gif" /></a></li>
                        <li><a href="#"><img src="img/tiendas/fnac.gif" /></a></li>
                        <li><a href="#"><img src="img/tiendas/corte_ingles.gif" /></a></li>
                        <li><a href="#"><img src="img/tiendas/zara.gif" /></a></li>
                    </ul>
                
                </div><!-- Fin del sidebar-B -->
			
			
			
			</div><!-- Fin del contenido_der -->
		
