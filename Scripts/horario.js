function MostrarHora(){
		var time = new Date();
		var hora = time.getHours();
		var minutos = time.getMinutes();
		var segundos = time.getSeconds();
		
		if(hora<10) hora = "0"+hora;
		if(minutos<10) minutos = "0"+minutos;
		if(segundos<10) segundos = "0"+segundos;
		var tempo = " - "+hora+":"+minutos+" hs";
		
		document.getElementById("timer").innerHTML=tempo;
		}
		function iniciar_hora(){
			setInterval(MostrarHora, 1000);
			}