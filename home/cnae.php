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
///////////////////////////////Seleção do cliente para aparecer o nome no inicio da página
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

}?>
  <h3>CNAE para o cliente: <strong style="color:#069;"><?php if($razao == ''){ echo $nome;} if($nome == ''){ echo $razao;}?></strong></h3>
<!-- fim da selecao do nome do cliente que aparece no inicio da pagina--> 

				<form name="atribuicao_cnae" action="" method="post" enctype="multipart/form-data">
                	<label>
                    	<span>Código CNAE</span>
 <script type="text/javascript">
 function mascaraCnae(campoData)
        {
        var codigo = campoData.value;
        if(codigo.length == 4)
        {
                codigo += '-';
                document.forms[0].codigo.value = codigo;
                return true;
        }
        if(codigo.length == 6)
        {
                codigo += '/';
                document.forms[0].codigo.value = codigo;
                return true;
        }
		
		
		
		
}
 </script>
                        <input type="text" name="codigo" id="codigo" onkeypress="mascaraCnae(this);" maxlength="9"/>
                        
                    </label>
                    
                    <input type="submit" name="atribuir" value="Atribuir" class="btn" />
                </form>
                <ul>
<?php
if(isset($_POST['atribuir'])){
$id_cliente = $_GET['cliente'];
$codigo = $_POST['codigo'];
if($codigo == ''){
	echo'
	<script type="text/javascript">
	alert("Informe o Código Cnae");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cnae&cliente='.$id_cliente.'">
	';}else{
$codigoNumerico = preg_replace("/[^0-9\s]/", "", $codigo);

$sqlLocalizaCnae = 'SELECT * FROM cnae WHERE codigo = :codigo';
try{
	$queryLocalizaCnae = $conecta->prepare($sqlLocalizaCnae);
	$queryLocalizaCnae->bindValue(':codigo',$codigoNumerico,PDO::PARAM_STR);
	$queryLocalizaCnae->execute();
    $countLocalizaCnae = $queryLocalizaCnae->rowCount(PDO::FETCH_ASSOC);
	$resultLocalizaCnae = $queryLocalizaCnae->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroLocalizaCnae){
		echo'Erro ao selecionar Cnae'.$erroLocalizaCnae->getMessage();
		}
	foreach($resultLocalizaCnae as $resLocalizaCnae){		
	$codigoCnae = $resLocalizaCnae['codigo'];
	$descricaoCnae = $resLocalizaCnae['cnae'];
		}
if($countLocalizaCnae <= 0){
	echo'<script type="text/javascript">
	alert("Código não encontrado");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cnae&cliente='.$id_cliente.'">';
	}else{
$sqlAtribuirCnae = 'INSERT INTO cnae_atribuicao_cliente (codigo_cnae,id_cliente, descricao_cnae) VALUES (:codigo_cnae, :id_cliente, :descricao_cnae)';
try{
	$queryAtribuirCnae = $conecta->prepare($sqlAtribuirCnae);
	$queryAtribuirCnae->bindValue(':codigo_cnae',$codigoCnae,PDO::PARAM_STR);
	$queryAtribuirCnae->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$queryAtribuirCnae->bindValue(':descricao_cnae',$descricaoCnae,PDO::PARAM_STR);
	$queryAtribuirCnae->execute();
	}catch(PDOexception $erroInsertAtribuicaoCnae){
		echo'Erro ao cadastrar Atribuição Cnae'.$erroInsertAtribuicaoCnae->getMessage();
		}}}}
$sqlSelectAtribuicaoCliente = 'SELECT * FROM cnae_atribuicao_cliente WHERE id_cliente = :id_cliente';
try{
	$querySelectAtribuicaoCliente = $conecta->prepare($sqlSelectAtribuicaoCliente);
	$querySelectAtribuicaoCliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$querySelectAtribuicaoCliente->execute();
	$resultSelectAtribuicaoCliente = $querySelectAtribuicaoCliente->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroSelectAtribuicaoCliente){
		echo'Erro ao Selecionar Atribuição Cnae'.$erroSelectAtribuicaoCliente->getMessage();
		}
		foreach($resultSelectAtribuicaoCliente as $resSelectAtribuicaoCliente){
			$idCnaeCliente = $resSelectAtribuicaoCliente['id_cnae_cliente'];
		    $codigoCnaeAtribuido = $resSelectAtribuicaoCliente['codigo_cnae'];
			$descricaoCnaeAtribuido = $resSelectAtribuicaoCliente['descricao_cnae'];
 		?>
        <li><a href="painel.php?exe=home/excluir_cnae&cnae=<?php echo $idCnaeCliente;?>">Excluir</a>
<?php if(strlen($codigoCnaeAtribuido) == 6)
     {echo $codigoMascara = '0'.substr($codigoCnaeAtribuido,0,3).'-'.substr($codigoCnaeAtribuido,3,1).'/'.substr($codigoCnaeAtribuido,4,2);
}elseif(strlen($codigoCnaeAtribuido) == 7){echo $codigoMascara = substr($codigoCnaeAtribuido,0,4).'-'.substr($codigoCnaeAtribuido,4,1).'/'.substr($codigoCnaeAtribuido,5,2);
}?> -  <p><?php echo $descricaoCnaeAtribuido;?></p></li>
		<?php
 
}
?>
              
                </ul>       
            </div><!-- cnae -->
        </div><!-- conteudo_interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>