<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Histórico</div><!--caminho-->
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
        	<div id="historico">
              		<table width="100%" class="listagem_clientes">
<?php
$id_cliente = $_GET['cliente'];
$sql_cliente = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id_cliente';

try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_cliente->execute();
	$result_cliente = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $error_cliente){
		echo'Erro o Cliente';}
		
	foreach($result_cliente as $res_cliente){
		$cliente_id = $res_cliente['cliente_id'];
		$cliente_nome = $res_cliente['cliente_nome'];
		$cliente_razao = $res_cliente['cliente_razao'];
		}
?>
  <tr>
    <td colspan="2"><strong>Cliente:</strong> <?php if($cliente_razao == ''){ echo $cliente_nome;} if($cliente_nome == ''){ echo $cliente_razao;}?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="voltar" value="voltar" class="btn" onClick="JavaScript: window.history.back();"/></td>
  </tr>
  
  
</table>
            	<form name="historico" action="" method="post" enctype="multipart/form-data">
                	<label>
            		<textarea name="historico" rows="3" cols="98"></textarea>
                    </label>
                    <input type="submit" name="enviar" value="Salvar" class="btn" />
                </form>
<?php if(isset($_POST['enviar'])){
$texto = $_POST['historico'];
$data = date('Y/m/d H:i:s');
if($texto == ''){
	echo'<script type="text/javascript">
	alert("Digite o histórico.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/historico&cliente='.$id_cliente.'"';
	}else{
$sqlHistorico = 'INSERT INTO historico (historico_id_cliente, historico_texto, historico_data) VALUES (:historico_id_cliente, :historico_texto, :historico_data)';
try{
	$queryHistorico = $conecta->prepare($sqlHistorico);
	$queryHistorico->bindValue(':historico_id_cliente',$id_cliente,PDO::PARAM_STR);
	$queryHistorico->bindValue(':historico_texto',$texto,PDO::PARAM_STR);
	$queryHistorico->bindValue(':historico_data',$data,PDO::PARAM_STR);
	$queryHistorico->execute();
	}catch(PDOexception $erroHistorico){
		echo'Erro ao Cadastrar o Histórico'.$erroHistorico->getMessage();
		}	
	}
}
?>
                <div id="texto_historico">
<?php
$sqlBuscaHistorico = 'SELECT * FROM historico WHERE historico_id_cliente = :id_cliente ORDER BY historico_id DESC';
try{
	$queryBuscaHistorico = $conecta->prepare($sqlBuscaHistorico);
	$queryBuscaHistorico->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$queryBuscaHistorico->execute();
	$resultBuscaHistorico = $queryBuscaHistorico->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroBuscaHistorico){
		echo'Erro ao Cadastrar o Histórico'.$erroBuscaHistorico->getMessage();
		}
		foreach($resultBuscaHistorico as $resBuscaHistorico){
			$data_historico = $resBuscaHistorico['historico_data'];
			$texto_historico = $resBuscaHistorico['historico_texto'];
	
?>
	<h1><?php if(isset($data_historico))echo date('d/m/Y H:i', strtotime($data_historico));?></h1>
    <p><?php echo $texto_historico;?></p>
<?php
		}
?>
                </div><!-- textoHistorico -->
            </div><!-- historico -->
        </div><!-- conteudo_interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>