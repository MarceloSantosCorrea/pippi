 
 function addCampo(id){
	el = document.getElementById(id);
	el.innerHTML += '<label> <span>Dia/M�s de vencimento</span><input type="text" name="data[]" class="data"  maxlength="5"/><span class="ex_data">Ex:99/99</span></label>';}