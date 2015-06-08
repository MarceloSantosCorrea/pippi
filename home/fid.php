<?php include_once('sistema/restrito_all.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Ficha de Inscrição Declarada (FID)</div><!--caminho-->
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
        	<div id="fid">
            	<form name="cliente_fid" action="painel.php?exe=home/fid_impressao" target="_blank" method="post" enctype="multipart/form-data">
                	<label>
                	<span>Cliente:<?php echo $id_client_honorario;?></span>
                    <select name="select_cliente">
                    	<option value="-1">Selecione o cliente</option>
                        <?php
                        $select_clientes = 'SELECT * FROM cadastro_clientes ORDER BY cliente_ordem_alfa ASC';
						try{
							$query_honorario = $conecta->prepare($select_clientes);
							$query_honorario->execute();
							
							$result_client_honorario = $query_honorario->fetchAll(PDO::FETCH_ASSOC);
							$count = $query_honorario->rowCount(PDO::FETCH_ASSOC);
							}catch(PDOexception $erro_client){
								echo $erro_client->getMessage();
								}
							foreach($result_client_honorario as $res_client_honorario){
		                    $id_client_honorario = $res_client_honorario['cliente_id'];
	                       	$nome_client_honorario = $res_client_honorario['cliente_nome'];
	                     	$razao_client_honorario = $res_client_honorario['cliente_razao'];
		
						?>
                        <option value="<?php echo $id_client_honorario;?>">
						<?php if($razao_client_honorario == '')
						{echo $nome_client_honorario;}
						else{echo $razao_client_honorario;}?></option>
                       <?php
                       } ?>
			
                    </select>
                </label>
                <label>
                    	<span>Responsável Técnico:</span>
                        <select name="tecnico1">
                        	<option value="-1">Selecione o Técnico Responsável</option>
<?php 
$sqlTecnicoResponsavel = 'SELECT * FROM cadastro_tecnico ORDER BY tecnico_nome ASC';
try{
	$queryTecnicoResponsavel = $conecta->prepare($sqlTecnicoResponsavel);
	$queryTecnicoResponsavel->execute();
	$resultTecnicoResponsavel = $queryTecnicoResponsavel->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroTecnicoResponsavel){
		echo'Erro ao selecionar os Técnicos'.$erroTecnicoResponsavel->getMessage();
		}
		foreach($resultTecnicoResponsavel as $resTecnicoResponsavel){
			$tecnicoId = $resTecnicoResponsavel['tecnico_id'];
			$tecnicoNome = $resTecnicoResponsavel['tecnico_nome'];			
?>
                            <option value="<?php echo $tecnicoId;?>"><?php echo $tecnicoNome;?></option>
<?php }?>                            
                        </select>
                    </label>
                    <fieldset>
                    	<legend>Outro Responsável Técnico</legend>
                    <label>
                    	<span>Nome:</span>
                        <input type="text" name="tecnicoNome2" />
                    </label>
                    <label>
                    	<span>Registro:</span>
                        <input type="text" name="tecnicoRegistro2" />
                    </label>
                    <label>
                    	<span>Orgão:</span>
                        <input type="text" name="tecnicoOrgao2" />
                    </label>
                    <label>
                    	<span>UF:</span>
                        <input type="text" name="tecnicoUf2" />
                    </label>
                    <label>
                    	<span>Fone:</span>
                        <input type="text" onkeypress="mascaraFone(this);" maxlength="14" name="tecnicoFone2" />
                    </label> 
                    </fieldset> 
                   <input type="submit" name="enviar" value="Enviar" class="btn" />
                </form>
               
            </div><!-- fid -->
        </div><!-- conteudo_interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>