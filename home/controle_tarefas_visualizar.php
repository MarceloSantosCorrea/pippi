<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início</div><!--caminho-->
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
       	  <div id="listagem_clientes">
        	<input type="button" name="voltar" value="Voltar" class="btn" />
          <!--listagem de cliente-->
        	
        	<table width="100%" border="0" class="listagem_clientes">
  <tr bgcolor="#E1F5FF">
    <td width="100%">&nbsp;&nbsp;Nome</td>
   </tr>
   <tr  bgcolor="#E1F5FF"> 
    <td width="100%" height="103" align="center">
    <form name="descrever_terefa " action="" method="post" enctype="multipart/form-data">
    	<textarea rows="5" cols="40"></textarea>
        <input type="text" name="salvar" value="Salvar" class="btn" />
    </form>
     </td>
  </tr>
</table>
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>