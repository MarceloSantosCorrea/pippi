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
            
        	<form name="controle_honorario" action="" method="post" enctype="multipart/form-data" style="height:100px;">
            	<label>
                	<span>Cliente:</span>
                    <select name="select_cliente">
                    	<option value="-1">Selecione o cliente</option>
<?php
$SelectClientes = mysql_query ("SELECT * FROM cadastro_clientes ORDER BY cliente_ordem_alfa ASC") or die (mysql_error());
while($resSelectCliente = mysql_fetch_array($SelectClientes)){
	$clienteId = $resSelectCliente['cliente_id'];
  $clienteNome = $resSelectCliente['cliente_nome'];
 $clienteRazao = $resSelectCliente['cliente_razao'];
?>
		<option value="<?php echo $clienteId;?>"><?php if($clienteRazao == ''){echo $clienteNome;}else{echo $clienteRazao;}?></option>
<?php
}
?>
                    </select>
                </label>
                
                <input type="submit" name="localizar" value="Localizar Cliente" class="btn" />
         </form>
<?php if(isset($_POST['localizar'])){
			 $select_cliente = $_POST['select_cliente'];
			 	if($select_cliente == '-1'){
					echo'<script type="text/javascript">
					alert("Selecione o Cliente");
					</script>';
					}else{
			 ?>
             
         <form name="" action="" enctype="multipart/form-data" method="post" >
         		<label>
            		<span>Nome/Razão Social</span>
                     
<?php
$ClienteSelecionado = mysql_query ("SELECT * FROM cadastro_clientes WHERE cliente_id = '$select_cliente'") or die (mysql_error());
while($resClienteSelecionado = mysql_fetch_array($ClienteSelecionado)){
								$clienteSelecionadoId = $resClienteSelecionado['cliente_id'];
								$clienteSelecionadoNome = $resClienteSelecionado['cliente_nome'];
								$clienteSelecionadoRazao = $resClienteSelecionado['cliente_razao'];
?>
<input type="hidden" name="id_cliente" value="<?php echo $clienteSelecionadoId;?>"/>
<input type="text" name="cliente" disabled="disabled" value="<?php if($clienteSelecionadoRazao == ''){echo $clienteSelecionadoNome;}else{echo $clienteSelecionadoRazao;}?>" /><?php
}
?>
                </label>      
            	<label>
                	<span>Data de Pagamento:</span>
                    <input type="text" name="dat_pagamento" id="data_3" style="width:120px;" />
                </label>
                <label style="width:270px;">
                	<span>Referente:</span>
                    <select name="mes" style="width:70px;">
                    	<option value="-1">Mês</option>
<?php
$SelectMes = mysql_query ("SELECT * FROM meses") or die (mysql_error());
while($ResMes = mysql_fetch_array($SelectMes)){
	$mesNome = $ResMes['mes_nome'];
	$mesValor = $ResMes['mes_valor'];
?>                          
                            <option value="<?php echo $mesValor;?>"><?php echo $mesNome;?></option>
<?php
}
?>	               </select>
				</label>
                <label style="width:70px;">
				<select name="ano" style="width:60px;">
                	<option value="-1">Ano</option>
<?php
$SelectAno = mysql_query ("SELECT * FROM anos WHERE ano >= '2010'") or die (mysql_error());
while($ResAno = mysql_fetch_array($SelectAno)){
	$Ano = $ResAno['ano'];
?>                
                	<option value="<?php echo $Ano;?>"><?php echo $Ano;?></option>
<?php
}
?>                   
                </select>
                </label>
                
                
                <label>
                	<span>Valor: R$</span>
                    <input type="text" name="valor" id="valor" style="width:80px;" onKeyPress="return(currencyFormat(this,'','.',event))"/>
                    
                </label>
                
                <input type="submit" name="pagamento" value="Salvar Pagamento" class="btn" />
                
                 
            </form>  
                
         <?php
		 }}elseif(isset($_GET['cliente'])){
			 $cliente = $_GET['cliente'];
			 	if($select_cliente == '-1'){
					echo'<script type="text/javascript">
					alert("Selecione o Cliente");
					</script>';
					}else{
			 ?>
             
         <form name="" action="" enctype="multipart/form-data" method="post" >
         		<label>
            		<span>Nome/Razão Social</span>
<?php
$ClienteSelecionado = mysql_query ("SELECT * FROM cadastro_clientes WHERE cliente_id = '$cliente'") or die (mysql_error());
while($resClienteSelecionado = mysql_fetch_array($ClienteSelecionado)){
								$clienteSelecionadoId = $resClienteSelecionado['cliente_id'];
								$clienteSelecionadoNome = $resClienteSelecionado['cliente_nome'];
								$clienteSelecionadoRazao = $resClienteSelecionado['cliente_razao'];
?>
<input type="hidden" name="id_cliente" value="<?php echo $clienteSelecionadoId;?>" />
<input type="text" name="cliente" disabled="disabled" value="<?php if($clienteSelecionadoRazao == ''){echo $clienteSelecionadoNome;}else{echo $clienteSelecionadoRazao;}?>" /><?php
}
?>
                </label>      
            	<label>
                	<span>Data de Pagamento:</span>
                    <input type="text" name="dat_pagamento" id="data_3" style="width:120px;" />
                </label>
                <label style="width:270px;">
                	<span>Referente:</span>
                    <select name="mes" style="width:70px;">
                    	<option value="-1">Mês</option>
<?php
$SelectMes = mysql_query ("SELECT * FROM meses") or die (mysql_error());
while($ResMes = mysql_fetch_array($SelectMes)){
	$mesNome = $ResMes['mes_nome'];
	$mesValor = $ResMes['mes_valor'];
?>                          
                            <option value="<?php echo $mesValor;?>"><?php echo $mesNome;?></option>
<?php
}
?>	               </select>
				</label>
                <label style="width:70px;">
				<select name="ano" style="width:60px;">
                	<option value="-1">Ano</option>
<?php
$SelectAno = mysql_query ("SELECT * FROM anos WHERE ano >= '2010'") or die (mysql_error());
while($ResAno = mysql_fetch_array($SelectAno)){
	$Ano = $ResAno['ano'];
?>                
                	<option value="<?php echo $Ano;?>"><?php echo $Ano;?></option>
<?php
}
?>                   
                </select>
                </label>
                
                
                <label>
                	<span>Valor: R$</span>
                    <input type="text" name="valor" id="valor" style="width:80px;" onKeyPress="return(currencyFormat(this,'','.',event))"/>
                    
                </label>
                
                <input type="submit" name="pagamento" value="Salvar Pagamento" class="btn" />
                
                 
            </form>  
                
         <?php
		 }}
			?>
			  
<?php 
if(isset($_POST['pagamento'])){
$dataPagamento = $_POST['dat_pagamento'];
$hora = date('H:i:s');
$dataTimestamp = substr($dataPagamento,6,4).'-'.substr($dataPagamento,3,2).'-'.substr($dataPagamento,0,2).' '.$hora;
$MesReferente = $_POST['mes'];
$AnoReferente = $_POST['ano'];
$valorPagamento = $_POST['valor'];	
$idCliente = $_POST['id_cliente'];

if($dataPagamento == ''){
	echo'<script type="text/javascript">
	alert("Informe a data do pagamento.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_honorarios&amp;cliente='.$idCliente.'">';
	}else if($MesReferente == '-1'){
		echo'<script type="text/javascript">
			alert("Informe o mês referente.");
			</script>
			<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_honorarios&amp;cliente='.$idCliente.'">';
		}else if($AnoReferente == '-1'){
			echo'<script type="text/javascript">
				alert("Informe o Ano referente.");
				</script>
				<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_honorarios&amp;cliente='.$idCliente.'">';
			}else if($valorPagamento == ''){
				echo'<script type="text/javascript">
				    alert("Informe o Valor do Pagamento.");
					</script>
					<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_honorarios&amp;cliente='.$idCliente.'">';
				}else{
$CadastrarPagamento = mysql_query ("INSERT INTO pagamento (data_pagamento, referente_mes, referente_ano, valor, id_cliente) 
										VALUES ('$dataTimestamp','$MesReferente','$AnoReferente','$valorPagamento','$idCliente')") or die (mysql_error());
if($CadastrarPagamento >= '1'){
				echo'<script type="text/javascript">
				    alert("Pagamento Efetuado com Sucesso.");
					</script>
					<meta http-equiv="refresh" content="0; url=painel.php?exe=home/controle_honorarios">';
  }
 }		 
}
?>
            
         
            </div><!-- controle honorarios -->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>