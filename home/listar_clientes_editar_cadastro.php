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
        	<div id="visualizar_cadastro">
<?php
$id_cliente = $_GET['cliente'];
$sql_select_listagem = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id_cliente';
try{
	$query_select_cliente = $conecta->prepare($sql_select_listagem);
	$query_select_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_select_cliente->execute();
	$resultado_clientes = $query_select_cliente->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_cliente){
	echo'Erro ao selecionar clientes'.$error_select_cliente->getMessage();
	}
	
	foreach($resultado_clientes as $res_clientes){
		$id = $res_clientes['cliente_id'];
		$nome = $res_clientes['cliente_nome'];
		$razao = $res_clientes['cliente_razao'];
		$fantasia = $res_clientes['cliente_fantasia'];
		$cnpj = $res_clientes['cliente_cnpj'];
		$insc_estadual = $res_clientes['cliente_insc_estadual'];
		$cpf_responsavel = $res_clientes['cliente_cpf_responsavel'];
		$cpf = $res_clientes['cliente_cpf'];
		$email = $res_clientes['cliente_email'];
		$fone_resid = $res_clientes['cliente_fone_resid'];
		$fone_cel = $res_clientes['cliente_fone_cel'];
		$data_cadastro = $res_clientes['cliente_data_cadastro'];
		$data_modificado = $res_clientes['cliente_data_modificado'];
		$endereco = $res_clientes['cliente_endereco'];
		$num_endereco = $res_clientes['cliente_num_endereco'];
		$compl_endereco = $res_clientes['cliente_compl_endereco'];
		$ref_endereco = $res_clientes['cliente_ref_endereco'];
		$cep = $res_clientes['cliente_cep'];
		$cidade = $res_clientes['cliente_cidade'];
		$estado = $res_clientes['cliente_estado'];
		$bairro = $res_clientes['cliente_bairro'];
		$aniversario = $res_clientes['cliente_aniversario_timestamp'];
		$cadastrado_por = $res_clientes['cliente_cadastrado_por'];
		$rg = $res_clientes['cliente_cadastro_rg'];
		$orgao = $res_clientes['cliente_cadastro_orgao'];
		$uf = $res_clientes['cliente_cadastro_estado'];
		$data_expedicao = $res_clientes['cliente_cadastro_data_expedicao'];
		$cliente_pai = $res_clientes['cliente_pai'];
		$cliente_mae = $res_clientes['cliente_mae'];
		
}?>
<?php if($razao == ''){ 
?>
<?php include 'cliente_fisico.php';?>
<?php
} if($nome == ''){
?>
<?php include 'cliente_juridico.php';?>
<?php
}
?>
       	  


			</div><!-- visualizar cadastro -->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>