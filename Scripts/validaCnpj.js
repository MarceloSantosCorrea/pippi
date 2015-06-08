// JavaScript Document
function validarCnpj(obj) { // recebe um objeto
var s = (obj.value).replace(/\D/g,'');
var tam=(s).length; // removendo os caracteres não numéricos
if (!(tam==14)){ // validando o tamanho
alert("'"+s+"' Não é um CNPJ válido!" ); // tamanho inválido
return false;
}
// se for CNPJ
if (tam==14){
if(!validaCNPJ(s)){ // chama a função que valida o CNPJ
alert("'"+s+"' Não é um CNPJ válido!" ); // se quiser mostrar o erro
obj.select(); // se quiser selecionar o campo enviado
return false;
}
obj.value=maskCNPJ(s); // se validou o CNPJ mascaramos corretamente
return true;
}
}
function validaCNPJ(CNPJ) {
var a = new Array();
var b = new Number;
var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
for (i=0; i<12; i++){
a[i] = CNPJ.charAt(i);
b += a[i] * c[i+1];
}
if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
b = 0;
for (y=0; y<13; y++) {
b += (a[y] * c[y]);
}
if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
return false;
}
return true;
}
function maskCNPJ(CNPJ){
return CNPJ.substring(0,2)+"."+CNPJ.substring(2,5)+"."+CNPJ.substring(5,8)+"/"+CNPJ.substring(8,12)+"-"+CNPJ.substring(12,14);
}