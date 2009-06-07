$(document).ready(function(){
	$("#precioVendedor,#precioPapeleta,#factorMagico,#paypalpc,#notariopc,#margenrifalia").blur(function(){
		$("#warnMsg").hide();
		var pvr = $("#precioVendedor").val();
		var pp = $("#precioPapeleta").val();
		var fm = $("#factorMagico").val();
		
		var paypalpc = $("#paypalpc").val();
		var notariopc = $("#notariopc").val();
		var margenrifalia = $("#margenrifalia").val();
		
		//total menos el iva es el precio de vendedor
		if(pvr!="" && pp!="" && fm!=""){
			pv 				= pvr*fm;
			iva 			= pv*0.16;
			totalMenosIva 	= pv-iva;
			hacienda 		= totalMenosIva*0.15;
			paypal 			= Math.round(totalMenosIva*paypalpc)/100;
			rifalia 		= Math.round(totalMenosIva*margenrifalia*100)/100;			
			notario 		= Math.round(totalMenosIva*notariopc*100)/100;;
			ingsincargas 	= totalMenosIva-hacienda-paypal-rifalia-notario;
			badicional 		= Math.round(ingsincargas-pvr*100)/100;
			numPapeletas 	= pv*pp;
			
			$("#precioVenta").val(pv);
			$("#iva").val(iva);
			$("#hacienda").val(hacienda);
			$("#paypal").val(paypal);
			$("#notario").val(notario);
			$("#rifalia").val(rifalia);
			$("#ingsincargas").val(ingsincargas);
			$("#benefadicio").val(badicional);
			$("#numPapeletas").val(numPapeletas);
			
			if(badicional<0){
				$("#warnMsg").show('slow');
			}
		}
		
		
	});
});