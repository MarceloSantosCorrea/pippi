<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Listagem de Clientes</div><!--caminho-->
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
       	  <div class="lista" style="height:auto; width:100%;" >
          <form name="localizar_cliente_tarefas" action="" method="post" enctype="multipart/form-data">
            	<label>
                	<span>Localizar Cliente</span>
                    <input type="text" name="busca" />
                    <input type="submit" name="buscar" value="Listar" class="btn" />
                </label>
                
                
            </form>
<?php

	
	$cliente = $_POST['busca'];
	
$pag = "$_GET[pag]";
if($pag >= '1'){
 $pag = $pag;
}else{
 $pag = '1';
}

$maximo = '15'; //RESULTADOS POR PÁGINA
$inicio = ($pag * $maximo) - $maximo;
$sql_select_listagem = mysql_query ("SELECT * FROM cadastro_clientes WHERE cliente_nome LIKE '%$cliente%' OR cliente_razao LIKE '%$cliente%' ORDER BY cliente_ordem_alfa ASC LIMIT $inicio,$maximo ") or die (mysql_error());
if(@mysql_num_rows($sql_select_listagem) <= '0'){
	echo'<div class="error2">Sua consulta não gerou nenhum resultado!</div>';
	}else{
while($res_clientes = mysql_fetch_array($sql_select_listagem)){
		$id = $res_clientes['cliente_id'];
		$nome = $res_clientes['cliente_nome'];
		$razao = $res_clientes['cliente_razao'];
		
$ContarHistorico = mysql_query ("SELECT * FROM historico WHERE historico_id_cliente = '$id'") or die (mysql_error());
$CountHistorico = mysql_num_rows($ContarHistorico);

$ContarHonorarios = mysql_query ("SELECT * FROM pagamento WHERE id_cliente = '$id'") or die (mysql_error());
$CountHonorarios = mysql_num_rows($ContarHonorarios);

$ContarObrigacoes = mysql_query ("SELECT * FROM atribuicao_cliente_obrigacao WHERE atribuicao_id_cliente = '$id' AND atribuicao_status = 'sim'") or die (mysql_error());
$CountObrigacoes = mysql_num_rows($ContarObrigacoes);

$ContarCnae = mysql_query ("SELECT * FROM cnae_atribuicao_cliente WHERE id_cliente = '$id'") or die (mysql_error());
$CountCnae = mysql_num_rows($ContarCnae);
?>
       	<table width="100%" border="0" class="listagem_clientes">
  <tr bgcolor="#E1F5FF">
    <td width="75%">&nbsp;&nbsp;<?php if($razao == ''){ echo $nome;} if($nome == ''){ echo $razao;}?></td>
    <td width="5%" align="center"><a href="painel.php?exe=home/historico&amp;cliente=<?php echo $id;?>" title="<?php if($CountHistorico == '0'){echo 'Não há Histórico registrado.';}elseif($CountHistorico == '1'){echo'Há '.$CountHistorico.' Histórico registrado.';}elseif($CountHistorico > '1'){echo'Há '.$CountHistorico.' Históricos registrados.';}?>">Histórico</a></td>
    <td width="6%" align="center"><a href="painel.php?exe=home/honorarios&amp;cliente=<?php echo $id;?>" title="<?php if($CountHonorarios == '0'){echo 'Não há pagamentos registrados.';}elseif($CountHonorarios == '1'){echo'Há '.$CountHonorarios.' pagamento registrado.';}elseif($CountHonorarios > '1'){echo'Há '.$CountHonorarios.' pagamentos registrados.';}?>">Honorários</a></td>
    <td width="6%" align="center"><a href="painel.php?exe=home/obrigacoes&amp;cliente=<?php echo $id;?>" title="<?php if($CountObrigacoes == '0'){echo 'Não há Obrigações Atribuidas.';}elseif($CountObrigacoes == '1'){echo'Há '.$CountObrigacoes.' Obrigação Atribuida.';}elseif($CountObrigacoes > '1'){echo'Há '.$CountObrigacoes.' Obrigações Atribuidas.';}?>">Obrigações</a></td>
    <td width="5%" align="center"><a href="painel.php?exe=home/listar_clientes_editar_cadastro&amp;cliente=<?php echo $id;?>">Cadastro</a></td>
    <td width="3%" align="center"><a href="painel.php?exe=home/cnae&amp;cliente=<?php echo $id;?>" title="<?php if($CountCnae == '0'){echo 'Não há Registro Cnae.';}elseif($CountCnae == '1'){echo'Há '.$CountCnae.' Registro Cnae.';}elseif($CountCnae > '1'){echo'Há '.$CountCnae.' Registros Cnae.';}?>">Cnae</a></td>

  </tr>
</table>
<?php 
}}
?> 
	</div><!-- lista -->
  <div class="pager">
<?php

$sql_res = mysql_query("SELECT * FROM cadastro_clientes WHERE cliente_nome LIKE '%$cliente%' OR cliente_razao LIKE '%$cliente%' ORDER BY cliente_ordem_alfa ASC");
$total = mysql_num_rows($sql_res);

$paginas = ceil($total/$maximo);
$links = '5'; //QUANTIDADE DE LINKS NO PAGINATOR

echo "<a href=\"painel.php?exe=home/listar_clientes&amp;pag=1\">Primeira Página</a>&nbsp;&nbsp;&nbsp;";

for ($i = $pag-$links; $i <= $pag-1; $i++){
if ($i <= 0){
}else{
echo"<a href=\"painel.php?exe=home/listar_clientes&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}echo "$pag &nbsp;&nbsp;&nbsp;";

for($i = $pag +1; $i <= $pag+$links; $i++){
if($i > $paginas){
}else{
echo "<a href=\"painel.php?exe=home/listar_clientes&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}
echo "<a href=\"painel.php?exe=home/listar_clientes&amp;pag=$paginas\">Última página</a>&nbsp;&nbsp;&nbsp;";


?>
</div><!--pager--> 
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>