<?
$anoAtual = date('Y');
$SelectAno = mysql_query ("SELECT * FROM anos WHERE ano = '$anoAtual'") or die (mysql_error());
if(@mysql_num_rows($SelectAno)<='0'){
for($i = 1900; $i <= $anoAtual; $i++){
$cadastrarAno = mysql_query ("INSERT INTO anos (ano) VALUES ('$i')") or die (mysql_error());
}
	
	}else{
		
		
	}

?>