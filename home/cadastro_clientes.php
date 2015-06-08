<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
<script src="Scripts/jquery.js" type="text/javascript"></script>
<script src="Scripts/validaCpf.js" type="text/javascript"></script>
<script src="Scripts/validaCnpj.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
	    $("#fisica").click(function(){
		  $("#radio2").hide("slow");
		  $("#radio1").show("slow");
		  $('#cnpj[type="text"]').val("");
		  $('#razao[type="text"]').val("");
		  $('#fantasia[type="text"]').val("");
		  $('#insc_estadual[type="text"]').val("");
		  $('#cpf_responsavel[type="text"]').val("");
		});
        $("#juridica").click(function(){
		  $("#radio2").show("slow");
		  $("#radio1").hide("slow");
		  $('#cpf[type="text"]').val("");
		  $('#nome[type="text"]').val("");
		  $('#rg[type="text"]').val("");
		  $('#org_expe[type="text"]').val("");
		  $('#estado_rg[type="text"]').val("");
		  $('#expedicao[type="text"]').val("");
		  $('#pai[type="text"]').val("");
		  $('#mae[type="text"]').val("");
		});
		
});
</script>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Cadastro de Clientes</div><!--caminho-->
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
  	<div id="cadastro_clientes">
  		<form name="form1" id="cadastro_clientes" action="painel.php?exe=home/cadastro_ok" method="post" >
        	<fieldset>
            	<legend>Cadastro de clientes</legend>
  					<label class="label">
                    	<span class="span">Cpf</span>
                        <input type="radio" name="radio" id="fisica" value="cpf"  class="input" value="cpf" />
                    </label>
                    
                    <label class="label">
                    	<span class="span">Cnpj</span>
                       <input type="radio" name="radio" id="juridica" value="cnpj" class="input" value="cnpj"/>
                    </label>
                
                   <div id="radio1" style="display:none; float:left;">
                    <label>

                    	<span>Cpf</span>
                        <input type="text" id="cpf" onkeypress="mascara(this,cpf)" maxlength="14" name="cpf" onblur="validarCpf(this)" /> 
                    </label>
                    <label>
                    	<span>Nome</span>
                        <input type="text" name="nome" id="nome"/>
                    </label>
                    <label>
                    	<span>RG</span>
                        <input type="text" name="rg" id="rg"/>
                    </label>
                    <label>
                    	<span>Orgão Expeditor</span>
                        <input type="text" name="org_expe" id="org_expe"/>
                    </label>
                     
                        
                    <label class="estado" style="width:350px; margin-left:115px;">
                    	<span style="width:30px ; margin-right:15px; ">Estado</span>
                        <select name="uf" style="width:60px; float:left;">
                        	<option value="-1">Uf</option>
  <?php
  $SelectUF = mysql_query ("SELECT * FROM uf") or die (mysql_error());
  while($resUf = mysql_fetch_array($SelectUF)){
	  $Uf = $resUf['ufNome'];
  ?>                          
                            <option value="<?php echo  $Uf;?>"><?php echo $Uf;?></option>
  <?php
  }
  ?>                          
                        </select>
                       	<span style="width:124px; float:left;">Data Expedissão</span>                        
                        <input type="text" name="expedicao" onkeypress="Mascara(this);" maxlength="11" style="width:83px; float:left;" id="expedicao"  />
                    </label>
                    <label>
                    	<span>Pai:</span>
                        <input type="text" name="pai" id="pai"/>
                    </label>
                    <label>
                    	<span>Mãe</span>
                        <input type="text" name="mae" id="mae"/>
                    </label>
                    <label class="aniversario">
                    	<span>Data de Aniversário</span>
                        <select name="aniversario_dia">
                        	<option value="-1">Dia</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                      </label>  
                      <label class="aniversario" style="width:50px; margin:2px 30px 0 30px;">  
                        <select name="aniversario_mes" style="width:100px;">
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
?>                         
                         </select>
                    </label>
                    <label class="aniversario" style="width:50px;  margin-left:50px;">  
                        <select name="aniversario_ano" style="width:60px;">
                        	<option value="-1">Ano</option>
  <?php
  $SelectAno = mysql_query ("SELECT * FROM anos") or die (mysql_error());
  while($resAnos = mysql_fetch_array($SelectAno)){
	  $Ano = $resAnos['ano'];
  ?>                          
                            <option value="<?php echo $Ano;?>"><?php echo $Ano;?></option>
  <?php
  }
  ?>                          
                        </select>
                    </label>
                    
                    </div><!--radio1-->
                     <div id="radio2"  style="display:none;">
                    <label>
                    	<span>Cnpj</span>
                        <input type="text" id="cnpj" onkeypress="mascara(this,cnpj)" maxlength="18" name="cnpj" onblur="validarCnpj(this)" />
                    </label>
                    
                    <label>
                    	<span>Razão Social</span>
                        <input type="text" name="razao" id="razao"  />
                    </label>
                    <label>
                    	<span>Nome Fantasia</span>
                        <input type="text" name="fantasia" id="fantasia" />
                    </label>
                    <label>
                    	<span>Inscrição Estadual</span>
                        <input type="text" name="insc_estadual" id="insc_estadual"  />
                    </label>
                    <label>
                    	<span>CPF Responsável</span>
                         <input type="text" name="cpf_reponsavel" id="cpf" onkeypress="mascara(this,cpf)" maxlength="14" onblur="validarCpf(this)" />
                    </label>
                    </div><!--radio2-->
                  <label>
                    	<span>Endereço</span>
                        <input type="text" name="endereco"  />
                    </label>
                    <label style="width:170px; margin-left:130px; ">
                    	<span style="width:30px;">N°</span>
                        <input type="text" name="numero_end" style="width:100px;"  />
                    </label>
                    <label style="width:155px;">
                    	<span style="width:20px;">Cep</span>
                        <input type="text" name="cep"  id="cep" onkeypress="mascara(this,cep)" maxlength="9" style="width:109px; float:left;"  />
                    </label>
                    <label>
                    	<span>Bairro</span>
                        <input type="text" name="bairro"  />
                    </label>
                    <label>
                    	<span>Complemento</span>
                        <input type="text" name="compl_end"  />
                    </label>
                    <label>
                    	<span>Referência</span>
                        <input type="text" name="referencia"  />
                    </label>
                    
                    <label style="width:176px; margin-left:110px;">
                    	<span style="width:50px;">Celular</span>
                        <input type="text" name="fone_cel" id="telefone" onkeypress="mascara(this,telefone)" maxlength="14" style="width:100px;"  /> 
                    </label>
                    <label style="width:180px; margin:0;">
                    	<span style="width:53px;">Telefone</span>
                        <input type="text" name="fone_resid" id="telefone" onkeypress="mascara(this,telefone)" maxlength="14" style="width:100px;"  />
                    </label>
                    <label style="width:226px; margin-left:110px;">
                    	<span style="width:50px;">Cidade</span>
                        <input type="text" name="cidade" id="telefone"  style="width:150px;"  /> 
                    </label>
                    <label class="aniversario" style="width:123px;  margin-left:0;"> 
                    <span style="width:48px; ">Estado</span> 
                        <select name="uf" style="width:60px;">
                        	<option value="-1">Uf</option>
  <?php
  $SelectUF = mysql_query ("SELECT * FROM uf") or die (mysql_error());
  while($resUf = mysql_fetch_array($SelectUF)){
	  $Uf = $resUf['ufNome'];
  ?>                          
                            <option value="<?php echo  $Uf;?>"><?php echo $Uf;?></option>
  <?php
  }
  ?>                          
                        </select>
                    </label>
                    <label>
                    	<span>E-mail</span>
                        <input type="text" name="email"  />
                    </label>
                    
                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn" /> 
  			</fieldset>
  		</form>
        </div><!-- cadastro de clientes -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>