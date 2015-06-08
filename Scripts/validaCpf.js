// a fun��o principal de valida��o
function validarCpf(obj) { // recebe um objeto
var s = (obj.value).replace(/\D/g,'');
var tam=(s).length; // removendo os caracteres n�o num�ricos
if (!(tam==11)){ // validando o tamanho
alert("'"+s+"' N�o � um CPF  v�lido!" ); // tamanho inv�lido
return false;
}

// se for CPF
if (tam==11 ){
if (!validaCPF(s)){ // chama a fun��o que valida o CPF
alert("'"+s+"' N�o � um CPF v�lido!" ); // se quiser mostrar o erro
obj.select(); // se quiser selecionar o campo em quest�o
return false;
}
obj.value=maskCPF(s); // se validou o CPF mascaramos corretamente
return true;
}

function validaCPF(s) {
var c = s.substr(0,9);
var dv = s.substr(9,2);
var d1 = 0;
for (var i=0; i<9; i++) {
d1 += c.charAt(i)*(10-i);
}
if (d1 == 0) return false;
d1 = 11 - (d1 % 11);
if (d1 > 9) d1 = 0;
if (dv.charAt(0) != d1){
return false;
}
d1 *= 2;
for (var i = 0; i < 9; i++) {
d1 += c.charAt(i)*(11-i);
}
d1 = 11 - (d1 % 11);
if (d1 > 9) d1 = 0;
if (dv.charAt(1) != d1){
return false;
}
return true;
}

// fun��o que mascara o CPF
function maskCPF(CPF){
return CPF.substring(0,3)+"."+CPF.substring(3,6)+"."+CPF.substring(6,9)+"-"+CPF.substring(9,11);
}
}