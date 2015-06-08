<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Listagem de Recibos Registrados</div><!--caminho-->
<?php
$logado = $_SESSION['MM_Username'];
$sql_select = 'SELECT * FROM login WHERE login_login = :logado';
try{
	$query_select = $conecta->prepare($sql_select);
	$query_select->bindValue(':logado',$logado,PDO::PARAM_STR);
	$query_select->execute();
	$result = $query_select->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select){
	echo'Erro ao selecionar';
	}
	foreach ($result as $res){
	 	$login_nome = $res['login_nome'];	
	}
?>
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y');?> <span id="timer"></span> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?>  
  
  <div id="conteudo">
  		<div id="conteudo_interno">
       	  <div id="filtroRecibo">
          		<div id="filtrarPor">
                	<form name="filtrarPor">
                    	<fieldset>
                        	<legend>Localizar Por:</legend>
                            	<label>
                           			 <input type="radio" name="filtro" id="FiltroCliente" />
                            			 <span>Cliente</span>
                                </label>
                                <label>
                            		 <input type="radio" name="filtro" id="FiltroData" />
                            			 <span>Data</span>
                                </label>
                        </fieldset>
                    </form>
                </div><!-- filtrarPor -->
<script type="text/javascript">
$(function(){
	$("#FiltroCliente").click(function(){
		$("#locateCliente").show('slow');
		$("#locateData").hide('slow');
		});	
	$("#FiltroData").click(function(){
		$("#locateCliente").hide('slow');
		$("#locateData").show('slow');
		});
});
</script>

                <div id="locateCliente" style="display:none;">
        	<form name="localizarReciboCliente" action="" method="post" enctype="multipart/form-data">
            	<label>
                    <select name="ReciboCliente">
                    	<option value="-1">Selecione o cliente</option>
<?php
$SelectClientes = mysql_query ("SELECT * FROM recibo GROUP BY reciboCliente ORDER BY reciboCliente ASC ") or die (mysql_error());
while($resSelectCliente = mysql_fetch_array($SelectClientes)){
	$IdRecibo = $resSelectCliente['reciboId'];
  $ClienteRecibo = $resSelectCliente['reciboCliente'];
 
?>
		<option value="<?php echo $ClienteRecibo;?>"><?php echo $ClienteRecibo;?></option>
<?php
}
?>
                    </select>
                    <input type="submit" name="searchCliente"  value="Listar" class="btnLocate" />
                </label>
                
                

            </div><!-- locateCliente -->
            <div id="locateData" style="display:none;">

            	<label>
                    <input type="text" name="ReciboData" id="data_1"/>
                    <input type="submit" name="searchCliente"  value="Listar" class="btnLocate" />
                </label>
                
                
            </form>
            </div><!-- locateData -->
  			</div><!--filtroRecibo-->
        	
        	
<?php




if(isset($_POST['searchCliente'])){
$buscaReciboData = $_POST['ReciboData'];
$buscaReciboCliente = $_POST['ReciboCliente'];
$ReciboDataTimestamp = substr($buscaReciboData,6,4).'-'.substr($buscaReciboData,3,2).'-'.substr($buscaReciboData,0,2);
$pag = "$_GET[pag]";
if($pag >= '1'){
 $pag = $pag;
}else{
 $pag = '1';
}

$maximo = '15'; //RESULTADOS POR PÁGINA
$inicio = ($pag * $maximo) - $maximo;

$ListagemRecibo = mysql_query ("SELECT * FROM recibo WHERE reciboDataFiltro = '$ReciboDataTimestamp' OR reciboCliente LIKE '%$buscaReciboCliente%' LIMIT $inicio,$maximo") or die (mysql_error());
while($resListagemRecibo = mysql_fetch_array($ListagemRecibo)){
		$ReciboId = $resListagemRecibo['reciboId'];
		$ReciboCliente = $resListagemRecibo['reciboCliente'];
		$ReciboData = $resListagemRecibo['reciboData'];
		$ReciboValor = $resListagemRecibo['reciboValor'];
		$ReciboDataFiltro = $resListagemRecibo['reciboDataFiltro'];
?>		
<table width="100%" border="0" class="listagem_clientes">
  <tr bgcolor="#E1F5FF">
    <td width="8%" align="right"> <?php echo $ReciboId;?> &nbsp;</td>
    <td width="42%"> <?php echo $ReciboCliente;?> </td>
    <td width="15%" align="center"><?php echo date('d/m/Y',strtotime($ReciboDataFiltro));?></td>
    <td width="10%" align="right"><?php echo number_format($ReciboValor, 2, ',', '.'); // retorna R$100.000,50 ?> &nbsp;</td>
    <td width="10%" align="center"><a href="painel.php?exe=home/recibo_impressao&amp;recibo=<?php echo $ReciboId;?>" target="_blank">Vizualizar</a></td>
    <td width="7%" align="center"><a href="javascript:abrir('info_alterar_dados_recibos.php?recibo=<?php echo $ReciboId;?>','600','300')">Alterar</a></td>
    <td width="8%" align="center"><a href="javascript:confirmDelete('painel.php?exe=home/excluir_recibo&amp;recibo=<?php echo $ReciboId;?>')">Excluir</a></td>
  </tr>
</table>		
<?php		
}}else{
if(isset($reciboGet)){$recibo = $_GET['recibo'];}else{$recibo == '';}	
$pag = "$_GET[pag]";
if($pag >= '1'){
 $pag = $pag;
}else{
 $pag = '1';
}

$maximo = '15'; //RESULTADOS POR PÁGINA
$inicio = ($pag * $maximo) - $maximo;

$ListagemRecibo = mysql_query ("SELECT * FROM recibo WHERE reciboId = '$recibo' or reciboId LIKE '%$recibo'   LIMIT $inicio,$maximo") or die (mysql_error());
while($resListagemRecibo = mysql_fetch_array($ListagemRecibo)){
		$ReciboId = $resListagemRecibo['reciboId'];
		$ReciboCliente = $resListagemRecibo['reciboCliente'];
		$ReciboData = $resListagemRecibo['reciboData'];
		$ReciboValor = $resListagemRecibo['reciboValor'];
		$ReciboDataFiltro = $resListagemRecibo['reciboDataFiltro'];	

?>
<table width="100%" border="0" class="listagem_clientes">
  <tr bgcolor="#E1F5FF">
    <td width="8%" align="right"> <?php echo $ReciboId;?> &nbsp;</td>
    <td width="42%"> <?php echo $ReciboCliente;?> </td>
    <td width="15%" align="center"><?php echo date('d/m/Y',strtotime($ReciboDataFiltro));?></td>
    <td width="10%" align="right"><?php echo number_format($ReciboValor, 2, ',', '.'); // retorna R$100.000,50 ?> &nbsp;</td>
    <td width="10%" align="center"><a href="painel.php?exe=home/recibo_impressao&amp;recibo=<?php echo $ReciboId;?>" target="_blank">Vizualizar</a></td>
    <td width="7%" align="center"><a href="javascript:abrir('info_alterar_dados_recibos.php?recibo=<?php echo $ReciboId;?>','600','300')">Alterar</a></td>
    <td width="8%" align="center"><a href="javascript:confirmDelete('painel.php?exe=home/excluir_recibo&amp;recibo=<?php echo $ReciboId;?>')">Excluir</a></td>
  </tr>
</table>

<?php 
}}
?>
<script type="text/javascript">
<!--
function confirmDelete(delUrl) {
  if (confirm("Deseja Excluir Este Recibo Permanentemente?")) {
    document.location = delUrl;
  }
}
</script>
<div class="pager">
<?php

$sql_res = mysql_query("SELECT * FROM recibo LIMIT $inicio,$maximo");
$total = mysql_num_rows($sql_res);

$paginas = ceil($total/$maximo);
$links = '5'; //QUANTIDADE DE LINKS NO PAGINATOR

echo "<a href=\"painel.php?exe=home/listar_recibos&amp;pag=1\">Primeira Página</a>&nbsp;&nbsp;&nbsp;";

for ($i = $pag-$links; $i <= $pag-1; $i++){
if ($i <= 0){
}else{
echo"<a href=\"painel.php?exe=home/listar_recibos&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}echo "$pag &nbsp;&nbsp;&nbsp;";

for($i = $pag +1; $i <= $pag+$links; $i++){
if($i > $paginas){
}else{
echo "<a href=\"painel.php?exe=home/listar_recibos&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}
echo "<a href=\"painel.php?exe=home/listar_recibos&amp;pag=$paginas\">Última página</a>&nbsp;&nbsp;&nbsp;";


?>
</div><!--pager-->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>