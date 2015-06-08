<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Pagamento de Honorários</div><!--caminho-->
<?php
//////////////////////////////////////////////////////////////////
$logado = $_SESSION['MM_Username'];
$sql_select = 'SELECT * FROM login WHERE login_login = :logado';
try{
	$query_select = $conecta->prepare($sql_select);
	$query_select->bindValue(':logado',$logado,PDO::PARAM_STR);
	$query_select->execute();												//// recupera o nome do usuario que esta logado
	$result = $query_select->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select){
	echo'Erro ao selecionar';
	}
	foreach ($result as $res){
	 	$login_nome = $res['login_nome'];	
	}
///////////////////////////////////////////////////////////////////
?>
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y');?> <span id="timer"></span> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?> 
 
  
  <div id="conteudo">
  		<div id="conteudo_interno">
  			<div id="controle_honorario">
<?php
$ExcluirAll = $_GET['excluir_obrigacao'];
$ExcluirCadatroObrigacao = $_GET['excluir2'];
$ExcluirDataVencimento = $_GET['excluir1'];
$obrigacao = $_GET['obrigacao'];
if(isset($_GET['excluir_obrigacao']) && !isset($_POST['localizar']) && !isset($_POST['cadastrarNovaData'])){
$ExcluirRegistroCadastroObrigacao = mysql_query ("DELETE FROM cadastro_obrigacao WHERE obrigacao_nome = '$ExcluirAll';") or die (mysql_error());
$ExcluirRegistroDataVencimento = mysql_query ("DELETE FROM data_vencimento_obrigacao WHERE obrig_data_nome_cadastro = '$ExcluirAll';") or die (mysql_error());
$ExcluirRegistroAgenda = mysql_query ("DELETE FROM pagina_agenda WHERE agenda_evento = '$ExcluirAll';") or die (mysql_error());	
	if($ExcluirRegistroCadastroObrigacao && $ExcluirRegistroDataVencimento && $ExcluirRegistroAgenda >= '1'){
		echo'<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_datas_obrigacoes"';
		}
	}
if(isset($_GET['excluir2']) && isset($_GET['excluir1']) && !isset($_POST['localizar']) && !isset($_POST['cadastrarNovaData'])){
$CountCadastroObrigacao = mysql_query ("SELECT * FROM cadastro_obrigacao WHERE obrigacao_md5 = '$obrigacao' ") or die (mysql_error());
if(@mysql_num_rows($CountCadastroObrigacao)<= '1'){
	echo'<script type="text/javascript">
	alert("Não pode excluir a última data.");
	
	</script>';
	}else{
$ExcluirDataCadastroObrigacao = mysql_query ("DELETE FROM cadastro_obrigacao WHERE obrigacao_id = '$ExcluirCadatroObrigacao'") or die (mysql_error());

$ExcluirDataVencimentoObrigacao = mysql_query ("DELETE FROM data_vencimento_obrigacao WHERE obrig_data_id = '$ExcluirDataVencimento'") or die (mysql_error());

$ExcluirDataAgenda = mysql_query ("DELETE FROM pagina_agenda WHERE agenda_data_text = '$ExcluirCadatroObrigacao'") or die (mysql_error());		
		}
}
?>
            
        	<form name="controle_honorario" action="" method="post" enctype="multipart/form-data" style="height:100px;">
            	<label>
                	<span>Obrigação:</span>
                    <select name="select_cliente">
                    	<option value="-1">Selecione a Obrigação</option>
<?php
$sqlBuscarNomeObrigacao = mysql_query("SELECT * FROM cadastro_obrigacao GROUP BY obrigacao_nome") or die (mysql_error());
while($resBuscarNomeObrigacao = mysql_fetch_array($sqlBuscarNomeObrigacao)){
								$md5_obrigacao = $resBuscarNomeObrigacao['obrigacao_md5'];
								$nome_obrigacao = $resBuscarNomeObrigacao['obrigacao_nome'];
?>
                        <option value="<?php echo $md5_obrigacao;?>"><?php echo $nome_obrigacao;?></option>
<?php
}
?>
                    </select>
                </label>                
                <input type="submit" name="localizar" value="Visualizar Vencimentos" class="btn" />                
         </form>


         <form name="" action="" enctype="multipart/form-data" method="post" >
         		
<?php

 if(isset($_POST['localizar'])){
$select_cliente = $_POST['select_cliente'];
if($select_cliente == '-1'){
					echo'<script type="text/javascript">
					alert("Selecione a Obrigação.");
					</script>
					<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_datas_obrigacoes">
					';
					
}else{
$sqlSelecionarNomeObrigacao = mysql_query("SELECT * FROM cadastro_obrigacao WHERE obrigacao_md5 = '$select_cliente' GROUP BY obrigacao_nome") or die (mysql_error());
while($resSelecionarNomeObrigacao = mysql_fetch_array($sqlSelecionarNomeObrigacao)){
								$obrigacao_id = $resSelecionarNomeObrigacao['obrigacao_id'];
								$md5_obrig = $resSelecionarNomeObrigacao['obrigacao_md5'];
								$nome_obrig = $resSelecionarNomeObrigacao['obrigacao_nome'];
								
?>
                <label>
                	<span style="width:110px;">Obrigação</span>
                    <input type="text" disabled="disabled" value="<?php echo $nome_obrig;?>" style="width:350px;"/>
                    <a href="javascript:abrir('info_renomear_obrigacao.php?obrigacao=<?php echo $nome_obrig;?>&amp;cod=<?php echo $md5_obrig;?>','450','150')">Renomear</a>
                    <a href="painel.php?exe=home/controle_datas_obrigacoes&amp;excluir_obrigacao=<?php echo $nome_obrig;?>">Excluir</a>
                </label>
                
         		<label>
<?php
}


$sqlSelecionarIdDataVencimentoObrigacao = mysql_query("SELECT * FROM data_vencimento_obrigacao WHERE obrig_data_id_obrigacao = '$select_cliente' ORDER BY obrig_data_vencimento") 
                                                      or die (mysql_error());
while($resSelecionarIdDataVencimentoObrigacao = mysql_fetch_array($sqlSelecionarIdDataVencimentoObrigacao)){
		$idDataVencimentoObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id'];
	  $dataDataVencimentoObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_vencimento'];;
		      $idCadastroObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id_cadastro'];;
		    $nomeCadastroObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id_obrigacao'];;

?>

    <span style="width:230px;">Data de Vencimento</span>
 <input type="text" name="data_vencimento" disabled="disabled" style="width:150px;"
 value="<?php echo $data_vencimento = substr($dataDataVencimentoObrigacao,0,2).'/'.substr($dataDataVencimentoObrigacao,3,2).'/'.date('Y');?>" />
 
  <a href="javascript:abrir('info_alterar_data.php?&amp;id_vencimento=<?php echo $idDataVencimentoObrigacao;?>&amp;data=<?php echo $dataDataVencimentoObrigacao;?>&amp;id_cadastro=<?php echo $idCadastroObrigacao;?>&amp;nome=<?php echo $nomeCadastroObrigacao;?>' ,'300','200')" name="salvar" id="salvar">Alterar</a>
  <a href="painel.php?exe=home/controle_datas_obrigacoes&obrigacao=<?php echo $nomeCadastroObrigacao;?>&amp;excluir1=<?php echo $idDataVencimentoObrigacao;?>&amp;excluir2=<?php echo $idCadastroObrigacao;?>">Excluir</a>
  
<?php
    }
   }}
?>

<?php
{
	if(!isset($_POST['localizar'])){
	  $obrigacao = $_GET['obrigacao'];
  $sqlSelecionarNomeObrigacao = mysql_query("SELECT * FROM cadastro_obrigacao WHERE obrigacao_md5 = '$obrigacao' GROUP BY obrigacao_nome") or die (mysql_error());
while($resSelecionarNomeObrigacao = mysql_fetch_array($sqlSelecionarNomeObrigacao)){
								$obrigacao_id = $resSelecionarNomeObrigacao['obrigacao_id'];
								$md5_obrig = $resSelecionarNomeObrigacao['obrigacao_md5'];
								$nome_obrig = $resSelecionarNomeObrigacao['obrigacao_nome'];
								
?>
                <label>
                	<span style="width:110px;">Obrigação</span>
                    <input type="text" disabled="disabled" value="<?php echo $nome_obrig;?>" style="width:350px;"/>
                    <a href="javascript:abrir('info_renomear_obrigacao.php?obrigacao=<?php echo $nome_obrig;?>&amp;cod=<?php echo $md5_obrig;?>','450','150')">Renomear</a>
                    <a href="painel.php?exe=home/controle_datas_obrigacoes&amp;excluir_obrigacao=<?php echo $nome_obrig;?>">Excluir</a>
                </label>
         		<label>
<?php
}


$sqlSelecionarIdDataVencimentoObrigacao = mysql_query("SELECT * FROM data_vencimento_obrigacao WHERE obrig_data_id_obrigacao = '$obrigacao' ORDER BY obrig_data_vencimento") 
                                                      or die (mysql_error());
while($resSelecionarIdDataVencimentoObrigacao = mysql_fetch_array($sqlSelecionarIdDataVencimentoObrigacao)){
		$idDataVencimentoObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id'];
	  $dataDataVencimentoObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_vencimento'];;
		      $idCadastroObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id_cadastro'];;
		    $nomeCadastroObrigacao = $resSelecionarIdDataVencimentoObrigacao['obrig_data_id_obrigacao'];;

?>
    <span style="width:230px;">Data de Vencimento</span>
 <input type="text" name="data_vencimento" disabled="disabled"style="width:150px;"
 value="<?php echo $data_vencimento = substr($dataDataVencimentoObrigacao,0,2).'/'.substr($dataDataVencimentoObrigacao,3,2).'/'.date('Y');?>" />
 
  <a href="javascript:abrir('info_alterar_data.php?&amp;id_vencimento=<?php echo $idDataVencimentoObrigacao;?>&amp;data=<?php echo $dataDataVencimentoObrigacao;?>&amp;id_cadastro=<?php echo $idCadastroObrigacao;?>&amp;nome=<?php echo $nomeCadastroObrigacao;?>' ,'300','200')" name="salvar" id="salvar">Alterar</a>
  <a href="painel.php?exe=home/controle_datas_obrigacoes&obrigacao=<?php echo $nomeCadastroObrigacao;?>&amp;excluir1=<?php echo $idDataVencimentoObrigacao;?>&amp;excluir2=<?php echo $idCadastroObrigacao;?>">Excluir</a>
<?php
    }
  }
}
?>
 </label>
 
</form>
<div id="nova_data">
<?php
if(isset($_GET['obrigacao']) && !isset($_POST['localizar'])){
?>
<form name="nova data" action="" method="post" enctype="multipart/form-data" style="width:550px;">
<input type="hidden" name="nome" value="<?php echo $nome_obrig;?>" />
<input type="hidden" name="md5" value="<?php echo $nomeCadastroObrigacao;?>" />

                      <div class="telefones" style=" float:left;" >
				<p class="campoTelefone" style="margin:5px 0; ">
                
                	<span style="width:250px; float:left;">Dia/Mês de vencimento Ex: 99/99</span>
                    <input type="text" name="nova_data[]" id="nova_data"  maxlength="5" style="width:150px;"  />
               
					<a href="#" style="margin:0; padding:0; float:right;"  class="removerCampo">Remover Campo</a>
				</p>
				</div>
				<p>
					<a href="#" class="adicionarCampo">Adicionar Data</a>
				</p>
                    
                     
                      <input type="submit" name="cadastrarNovaData" id="cadastrarNovaData" value="Incluir datas" class="btn" />  
                   </form>
  </div><!-- nova data -->
<?php
}
if(isset($_POST['localizar'])){
?>
<div id="nova_data">
<form name="novaData" action="" method="post" enctype="multipart/form-data" style="width:550px;">
<input type="hidden" name="nome" value="<?php echo $nome_obrig;?>" />
<input type="hidden" name="md5" value="<?php echo $nomeCadastroObrigacao;?>" />

                      <div class="telefones" style=" float:left;" >
				<p class="campoTelefone" style="margin:5px 0; ">
                
                	<span style="width:250px; float:left;">Dia/Mês de vencimento Ex: 99/99</span>
                    <input type="text" name="nova_data[]" id="nova_data"  maxlength="5" style="width:150px;"  />
               
					<a href="#" style="margin:0; padding:0; float:right;"  class="removerCampo">Remover Campo</a>
				</p>
				</div>
				<p>
					<a href="#" class="adicionarCampo">Adicionar Data</a>
				</p>
                    
                   
                      <input type="submit" name="cadastrarNovaData" id="cadastrarNovaData" value="Incluir datas" class="btn" /> 
<?php
}
?>  
<?php
if(isset($_POST['cadastrarNovaData'])){
  $obrigacaoNome = $_POST['nome']; ;
 $obrigacaoData = $_POST['nova_data'];

 $obrigacaoMd5 = $_POST['md5'];	
 $contarCampo = count($obrigacaoData);


for($i = 0; $i < $contarCampo; $i++){
	if(empty($obrigacaoData[$i])){
	echo'<script type="text/javascript">
	alert("Existe um campo em branco, e o mesmo não pôde ser cadastrado.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_datas_obrigacoes&amp;obrigacao='.$obrigacaoMd5.'">';
	}else{
$SelectCadastroObrigacaoDuplicado = mysql_query("SELECT * FROM cadastro_obrigacao WHERE obrigacao_data = '$obrigacaoData[$i]/0000' AND obrigacao_nome = '$obrigacaoNome'") or die (mysql_error());
if(@mysql_num_rows($SelectCadastroObrigacaoDuplicado)>= '1'){
	echo'<script type="text/javascript">
	alert("Não pode cadastrar datas Duplicadas.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_datas_obrigacoes&amp;obrigacao='.$obrigacaoMd5.'">
	';
	}else{		
		
$CadastraCadastroObrigacao = mysql_query("INSERT INTO cadastro_obrigacao (obrigacao_nome, obrigacao_data, obrigacao_md5) VALUES ('$obrigacaoNome', '$obrigacaoData[$i]/0000', '$obrigacaoMd5')") or die (mysql_error());

$SelectDataIncluidaCadastroObrigacao = mysql_query ("SELECT * FROM cadastro_obrigacao WHERE obrigacao_data = '$obrigacaoData[$i]/0000' AND obrigacao_nome = '$obrigacaoNome' ") or die (mysql_error());
while($resDataIncluida = mysql_fetch_array($SelectDataIncluidaCadastroObrigacao)){
	$idDataIncluida = $resDataIncluida['obrigacao_id'];
	
$cadastraDataVencimentoObrigacao = mysql_query ("INSERT INTO data_vencimento_obrigacao (obrig_data_vencimento, obrig_data_id_obrigacao, obrig_data_id_cadastro,  obrig_data_nome_cadastro) VALUES ('$obrigacaoData[$i]/0000', '$obrigacaoMd5', '$idDataIncluida', '$obrigacaoNome')") or die (mysql_error()); 
}
if($CadastraCadastroObrigacao >= '1'){
	echo'<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_datas_obrigacoes&amp;obrigacao='.$obrigacaoMd5.'">
					';
	}}
	}	
	}}



?>
</form>

 </div><!-- nova data -->
            </div><!-- controle honorarios -->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->
<?php include_once('atualizacoes_automaticas/CadastroDasDatasDasObrigacoesNaAgenda.php');?>
<?php include_once('footer.php');?>