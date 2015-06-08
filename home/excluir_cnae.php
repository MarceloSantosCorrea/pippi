<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; CNAE</div><!--caminho-->
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
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?>  
  
  <div id="conteudo">
		<div id="conteudo_interno">
        	<div id="cnae">


<?php

$AtribuicaoCnae = $_GET['cnae'];
$sqlIdCliente = 'SELECT * FROM cnae_atribuicao_cliente WHERE id_cnae_cliente = :AtribuicaoCnae';
try{
	$queryIdCliente = $conecta->prepare($sqlIdCliente);
	$queryIdCliente->bindValue(':AtribuicaoCnae',$AtribuicaoCnae,PDO::PARAM_STR);
	$queryIdCliente->execute();
	$resultIdCliente = $queryIdCliente->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroIdCliente){
		echo'Erro ao Selecionar Atribuição Cnae'.$erroIdCliente->getMessage();
		}
		foreach($resultIdCliente as $resIdCliente){
			$idCliente = $resIdCliente['id_cliente'];
		}
$sqlDeletarAtribuicaoCnae = 'DELETE FROM cnae_atribuicao_cliente WHERE id_cnae_cliente = :AtribuicaoCnae';
try{
	$queryDeletarAtribuicaoCnae = $conecta->prepare($sqlDeletarAtribuicaoCnae);
	$queryDeletarAtribuicaoCnae->bindValue(':AtribuicaoCnae',$AtribuicaoCnae,PDO::PARAM_STR);
	$queryDeletarAtribuicaoCnae->execute();
	echo'<script type="text/javascript">
	alert("Excluido com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cnae&cliente='.$idCliente.'">';
	}catch(PDOexception $erroDeletarAtribuicaoCnae){
		echo'Erro ao Deletar Atribuição Cnae'.$erroDeletarAtribuicaoCnae->getMessage();
		}
	
?>

              
                    
                </ul>       
            </div><!-- cnae -->
        </div><!-- conteudo_interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>