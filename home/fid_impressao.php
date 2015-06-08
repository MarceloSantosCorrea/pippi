<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include_once("Connections/config_pdo.php");
include_once("conexao.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>cadastro fid</title>
<link href="home/style_fid.css" rel="stylesheet" type="text/css" />
</head>
<?php if(isset($_POST['enviar'])){
$id_client_honorario = $_POST['select_cliente'];
	$select_clientesFid = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id_client_honorario';
						try{
							$query_FID = $conecta->prepare($select_clientesFid);
							$query_FID->bindValue(':id_client_honorario',$id_client_honorario,PDO::PARAM_STR);
							$query_FID->execute();
							
							$result_client_FID = $query_FID->fetchAll(PDO::FETCH_ASSOC);
							
							}catch(PDOexception $erro_client){
								echo $erro_client->getMessage();
								}
							foreach($result_client_FID as $res_clientes){
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
		$sala = $res_clientes['cliente_sala'];
		$fone_cel = $res_clientes['cliente_fone_cel'];
		$data_cadastro = $res_clientes['cliente_data_cadastro'];
		$data_modificado = $res_clientes['cliente_data_modificado'];
		$endereco = $res_clientes['cliente_endereco'];
		$num_endereco = $res_clientes['cliente_num_endereco'];
		$compl_endereco = $res_clientes['cliente_compl_endereco'];
		$ref_endereco = $res_clientes['cliente_ref_endereco'];
		$cep = $res_clientes['cliente_cep'];
		$bairro = $res_clientes['cliente_bairro'];
		$aniversario = $res_clientes['cliente_aniversario_timestamp'];
		$cadastrado_por = $res_clientes['cliente_cadastrado_por'];
		$rg = $res_clientes['cliente_cadastro_rg'];
		$orgao = $res_clientes['cliente_cadastro_orgao'];
		$uf = $res_clientes['cliente_cadastro_estado'];
		$data_expedicao = $res_clientes['cliente_cadastro_data_expedicao'];
		$mae = $res_clientes['cliente_mae'];
		$pai = $res_clientes['cliente_pai'];
		}
			}
				
					   ?>
<body>
<div id="geral">
	<div id="box">

	<div id="topo">
    
    	<div id="topo_bloco_um">
        	<a href="javascript:self.print()"><img src="images/escudo.png" border="0"  /></a>
            <p>Exmo. Sr. Prefeito Municipal<br />
            Solicito:</p>
            
        </div><!-- bloco_um -->
        
        <div id="topo_bloco_dois">
        	<p>Ficha de inscrição Declarada (FID) </p><span>1</span>
        </div><!-- bloco_dois -->
        
        <div id="topo_bloco_tres">
        	
            <form name="form1" action="" method="post" enctype="multipart/form-data">
            	<label>
                <input type="checkbox" name="alvara_provisorio" />
            	<span>Alvará Provisório</span>
                </label>
                <label>
                <input type="checkbox" name="alvara_localizacao"  />
            	<span>Alvará de Localização</span>
                </label>
                <label class="horizontal">
                <input type="checkbox" name="alvara_sanitario" />
            	<span>Alvará Sanitário</span>
                </label>
                <label class="horizontal">
                <input type="checkbox" name="licenca_especial" />
            	<span>Licença Especial</span>
                </label>
                <label class="horizontal">
                <input type="checkbox" name="eventos" />
            	<span>Eventos</span>
                </label>
                <label>
                <input type="checkbox" name="registro_issqn" />
            	<span>Registro no ISSQN</span>
                </label>
                <label>
                <input type="checkbox" name="licenciamento_ambiental" />
            	<span>Licenciamento Ambiental </span>
                </label>
                <label class="baixo">
                <input type="checkbox" name="previo" />
            	<span>Prévio </span>
                </label>
                <label class="baixo">
                <input type="checkbox" name="de_intalacao" />
            	<span>de Instalação</span>
                </label>
                <label class="baixo">
                <input type="checkbox" name="operacional" />
            	<span>Operacional</span>
                </label>
            </form>
            
        </div><!-- bloco_um -->
        
        <div id="topo_bloco_quatro">
        	
            <div id="topo_bloco_quatro_um">
            	
              <form name="form2" action="" method="post" enctype="multipart/form-data">
                	<label>
                    	<input type="checkbox" name="inclusao" />
                        <span>INCLUSÃO</span>
                    </label>
                    <label>
                    	<input type="checkbox" name="renovacao" />
                        <span>RENOVAÇÃO</span>
                    </label>
                    <label>
                    	<input type="checkbox" name="alteracao" />
                        <span>ALTERAÇÃO</span>
                    </label><br />
                    <label class="linha2">
                    	<input type="checkbox" name="atividade" />
                        <span>Atividade</span>
                    </label>
                    <label class="linha2">
                    	<input type="checkbox" name="socios" />
                        <span>Sócios</span>
                    </label>
                    <label class="linha2">
                    	<input type="checkbox" name="endereco" />
                        <span>Endereço</span>
                    </label>
                    <label class="linha2">
                    	<input type="checkbox" name="razao_social" />
                        <span>Razão Social</span>
                    </label>
                </form>
                
            </div><!-- topo_bloco_quatro_um -->
            
          <div id="topo_bloco_quatro_dois">
            
            	<form name="form3" action="" method="post" enctype="multipart/form-data">
                	<h1>ABASTECIMENTO DE ÁGUA:</h1>
                    <label>
                    	<input type="checkbox" name="caixadagua" />
                        <span>caixa d'agua</span>
                	</label>
                    <label>
                    	<input type="checkbox" name="direto_corsan" />
                        <span>direto CORSAN</span>
                	</label>
                </form>
             </div><!-- topo_bloco_quatro_dois -->
            
          <div id="topo_bloco_quatro_tres">
            
           	<form name="form4" action="" method="post"  enctype="multipart/form-data">
                	<label>
                    	<input type="checkbox" name="baixa" />
                        <span>BAIXA</span>
                	</label>
                    <label>
                    	<input type="checkbox" name="deferida" />
                        <span>deferida</span>
                	</label>
                    <label>
                    	<input type="checkbox" name="baixa" />
                        <span>indeferida</span>
                	</label>
                    <h1>____________</h1>
                </form>
            
          </div><!-- topo_bloco_quatro_tres -->
            
      </div><!-- bloco_um -->
    
    </div><!-- topo -->
    
    <div id="conteudo_um">
    	
    	<h1>Para o que passo as informações abaixo, pelas quais assumo inteira responsabilidade, na forma da lei.</h1>
        
      <div id="formulario_um">
        <table width="100%" height="52%" class="tabela">
  <tr>
    <td  colspan="2" height="20%">&nbsp;NOME OU RAZ&Atilde;O SOCIAL:  <?php if($razao == ''){echo $nome;}else{echo $razao;}?></td>
  </tr>
  <tr>
    <td colspan="2" height="16%">&nbsp;NOME FANTASIA: <?php echo $fantasia;?></td>
  </tr>
  <tr>
    <td  height="16%">&nbsp;CIC/CNPJ: <?php if($cpf == ''){echo $cnpj;}else{echo $cpf;} ?></td>
    <td width="50%">&nbsp;INSCRI&Ccedil;&Atilde;O ESTADUAL: <?php echo $insc_estadual;?></td>
  </tr>
  </table>
  <table width="100%" height="32%" class="tabela">
  <tr>
    <td colspan="4" height="16%">&nbsp;PONTO DE REFER&Ecirc;NCIA: <?php echo $ref_endereco;?></td>
  </tr>
  <tr>
    <td width="57%" height="16%">&nbsp;RUA: <?php echo $endereco;?></td>
    <td width="13%">&nbsp;N&deg;: <?php echo $num_endereco;?></td>
    <td  width="14%">&nbsp;SALA: <?php echo $sala;?></td>
    <td width="16%">&nbsp;CEP: <?php echo $cep;?></td>
  </tr>
  </table>
  <table width="100%" height="16%" class="tabela">
  <tr>
    <td height="16%" width="48%" >&nbsp;BAIRRO: <?php echo $bairro;?></td>
    <td width="27%">&nbsp;TELEFONE: <?php echo $fone_resid;?></td>
    <td width="25%">&nbsp;CELULAR: <?php echo $fone_cel;?></td>
  </tr>
</table>

      </div><!-- formulario -->
    </div><!-- conteudo_um -->
    
    <div id="conteudo_dois"> 
     <div class="titulo">
 <h1>Atividades Contratuais:</h1><h2>Assinalar as Desenvolvidas</h2><h3>Cód. Atividade</h3>
       </div><!-- titulo --> 
      <div id="formulario_dois">
        <table width="100%" height="100%" class="tabela">
  <tr>
  <?php
  ////busca Cnae do Cliente

  $numero = 0;
$sqlBuscaCnae = mysql_query("SELECT * FROM cnae_atribuicao_cliente WHERE id_cliente = '$id_client_honorario' LIMIT 3") or die (mysql_error());
while($resBuscaCnae = mysql_fetch_array($sqlBuscaCnae)){
	$codigoCnaeAtribuido = $resBuscaCnae['codigo_cnae'];
	$descricaoCnaeAtribuido = $resBuscaCnae['descricao_cnae'];
	$numero++;
	
////
  ?>
    <td width="80%">&nbsp; <?php echo $numero;?> 
    <p<?php if(strlen($descricaoCnaeAtribuido) > 91){?> style="font-size:14px;"<?php }else{?>style="font-size:16px;"<?php }?>><?php echo $descricaoCnaeAtribuido;?></p></td>
    <td width="4%"><input type="checkbox" style=" margin-left:10px;" /></td>
   <td  width="20%" align="center"><?php if(strlen($codigoCnaeAtribuido) == 6)
     {echo $codigoMascara = '0'.substr($codigoCnaeAtribuido,0,3).'-'.substr($codigoCnaeAtribuido,3,1).'/'.substr($codigoCnaeAtribuido,4,2);
}elseif(strlen($codigoCnaeAtribuido) == 7){echo $codigoMascara = substr($codigoCnaeAtribuido,0,4).'-'.substr($codigoCnaeAtribuido,4,1).'/'.substr($codigoCnaeAtribuido,5,2);
}?></td>
  </tr><?php }

  ?>
  
  </table>
  
  

      </div><!-- formulario dois-->
    </div><!-- conteudo dois -->
    
    <div id="conteudo_tres">
    
    <h1>Identificação: Autônomo / Sócio Responsável da Empresa</h1>
        
      <div id="formulario_tres">
        <table width="100%" height="100%" class="tabela">
  <tr>
  <?php

$sqlSocioResponsavel = 'SELECT * FROM cadastro_clientes WHERE cliente_cpf = :cpf_responsavel';
try{
	$querySocioResponsavel = $conecta->prepare($sqlSocioResponsavel);
	$querySocioResponsavel->bindValue(':cpf_responsavel',$cpf_responsavel,PDO::PARAM_STR);
	$querySocioResponsavel->execute();
	$resultSocioResponsavel = $querySocioResponsavel->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroSocioResponsavel){
		echo'Erro ao selecionar o responsavel'.$erroSocioResponsavel->getMessage();
		}
		foreach($resultSocioResponsavel as $resSocioResponsavel){
		$SocioResponsavel = $resSocioResponsavel['cliente_cpf_responsavel'];
		$SocioResponsavel_id = $resSocioResponsavel['cliente_id'];
		$SocioResponsavel_nome = $resSocioResponsavel['cliente_nome'];
		$SocioResponsavel_razao = $resSocioResponsavel['cliente_razao'];
		$SocioResponsavel_fantasia = $resSocioResponsavel['cliente_fantasia'];
		$SocioResponsavel_cnpj = $resSocioResponsavel['cliente_cnpj'];
		$SocioResponsavel_insc_estadual = $resSocioResponsavel['cliente_insc_estadual'];
		$SocioResponsavel_cpf_responsavel = $resSocioResponsavel['cliente_cpf_responsavel'];
		$SocioResponsavel_cpf = $resSocioResponsavel['cliente_cpf'];
		$SocioResponsavel_email = $resSocioResponsavel['cliente_email'];
		$SocioResponsavel_fone_resid = $resSocioResponsavel['cliente_fone_resid'];
		$SocioResponsavel_sala = $resSocioResponsavel['cliente_sala'];
		$SocioResponsavel_fone_cel = $resSocioResponsavel['cliente_fone_cel'];
		$SocioResponsavel_data_cadastro = $resSocioResponsavel['cliente_data_cadastro'];
		$SocioResponsavel_data_modificado = $resSocioResponsavel['cliente_data_modificado'];
		$SocioResponsavel_endereco = $resSocioResponsavel['cliente_endereco'];
		$SocioResponsavel_num_endereco = $resSocioResponsavel['cliente_num_endereco'];
		$SocioResponsavel_compl_endereco = $resSocioResponsavel['cliente_compl_endereco'];
		$SocioResponsavel_ref_endereco = $resSocioResponsavel['cliente_ref_endereco'];
		$SocioResponsavel_cep = $resSocioResponsavel['cliente_cep'];
		$SocioResponsavel_bairro = $resSocioResponsavel['cliente_bairro'];
		$SocioResponsavel_aniversario = $resSocioResponsavel['cliente_aniversario_timestamp'];
		$SocioResponsavel_cadastrado_por = $resSocioResponsavel['cliente_cadastrado_por'];
		$SocioResponsavel_rg = $resSocioResponsavel['cliente_cadastro_rg'];
		$SocioResponsavel_orgao = $resSocioResponsavel['cliente_cadastro_orgao'];
		$SocioResponsavel_uf = $resSocioResponsavel['cliente_cadastro_estado'];
		$SocioResponsavel_data_expedicao = $resSocioResponsavel['cliente_cadastro_data_expedicao'];
		$SocioResponsavel_mae = $resSocioResponsavel['cliente_mae'];
		$SocioResponsavel_pai = $resSocioResponsavel['cliente_pai'];
			}


  ?>
    <td height="20%" colspan="3">&nbsp;NOME: <?php echo $SocioResponsavel_nome;?></td>
    </tr>
  <tr>
    <td height="20%" colspan="3">&nbsp;ENDERE&Ccedil;O RESIDENCIAL:
	<?php echo $SocioResponsavel_endereco;?> <?php echo $SocioResponsavel_num_endereco;?> <?php echo $SocioResponsavel_bairro;?> <?php echo $SocioResponsavel_cep;?> <?php echo $SocioResponsavel_ref_endereco;?>
    </td>
    </tr>
  <tr>
    <td  height="20%"colspan="3">&nbsp;FILIA&Ccedil;&Atilde;O:<?php echo $SocioResponsavel_pai;?> - <?php echo $SocioResponsavel_mae;?></td>
    </tr>
  <tr>
    <td height="20%" width="34%">&nbsp;CPF: <?php echo $SocioResponsavel_cpf;?></td>
    <td width="33%">&nbsp;CI: <?php echo $SocioResponsavel_rg;?></td>
    <td width="33%">&nbsp;TELEFONE: <?php echo $SocioResponsavel_fone_resid;?></td>
  </tr>
  <tr>
    <td height="20%" colspan="2">&nbsp;CARTEIRA  DE &Oacute;RG&Atilde;O DE CLASSE:</td>
    <td>&nbsp;CELULAR: <?php echo $SocioResponsavel_fone_cel;?></td>
  </tr>
</table>



      </div><!-- formulario -->
    
    </div><!-- conteudo tres -->
    
    <div id="conteudo_quatro">
<div class="titulo">
 <h1>Responsabilidade Técnica:</h1>
       </div><!-- titulo --> 
      <div id="formulario_quatro">
 <table width="100%" height="100%" class="tabela">
  <tr>
<?php
if(isset($_POST['enviar'])){
$idTecnico = $_POST['tecnico1'];
$nome2 = strip_tags(trim($_POST['tecnicoNome2']));
$registro2 = strip_tags(trim($_POST['tecnicoRegistro2']));
$orgao2 = strip_tags(trim($_POST['tecnicoOrgao2']));
$uf2 = strip_tags(trim($_POST['tecnicoUf2']));
$fone2 = strip_tags(trim($_POST['tecnicoFone2']));

$sqlTecnicoResponsavel = 'SELECT * FROM cadastro_tecnico WHERE tecnico_id = :idTecnico';
try{
	$queryTecnicoResponsavel = $conecta->prepare($sqlTecnicoResponsavel);
	$queryTecnicoResponsavel->bindValue(':idTecnico',$idTecnico,PDO::PARAM_STR);
	$queryTecnicoResponsavel->execute();
	$resultTecnicoResponsavel = $queryTecnicoResponsavel->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erroTecnicoResponsavel){
		echo'Erro ao selecionar os Técnicos'.$erroTecnicoResponsavel->getMessage();
		}
		foreach($resultTecnicoResponsavel as $resTecnicoResponsavel){
			$tecnicoId = $resTecnicoResponsavel['tecnico_id'];
			$tecnicoNome = $resTecnicoResponsavel['tecnico_nome'];
			$tecnicoRegistro = $resTecnicoResponsavel['tecnico_registro'];
			$tecnicoOrgao = $resTecnicoResponsavel['tecnico_orgao'];
			$tecnicoUf = $resTecnicoResponsavel['tecnico_uf'];
			$tecnicoFone = $resTecnicoResponsavel['tecnico_fone'];
	
	}
}
?>  

    <td width="50%">&nbsp;Responsável Técnico: <?php echo $tecnicoNome;?></td>
    <td width="50%">&nbsp;Responsável Técnico: <?php echo $nome2;?></td>
  </tr>
  <tr>
    <td>&nbsp;N° Registro: <?php echo $tecnicoRegistro;?> <?php echo $tecnicoOrgao;?> <?php echo $tecnicoUf;?> Fone: <?php echo $tecnicoFone;?></td>
    <td>&nbsp;N° Registro: <?php echo $registro2;?> <?php echo $orgao2;?> <?php echo $uf2;?> Fone: <?php echo $fone2;?></td>
  </tr>
  <tr>
    <td>&nbsp;Assinatura:</td>
    <td>&nbsp;Assinatura:</td>
  </tr>
 </table>
  
  

      </div><!-- formulario -->
    </div><!-- conteudo quatro -->
    
    <div id="conteudo_cinco">
<div class="titulo">
 <h1>Anexo FID</h1><span>2</span><h2>Sócios / Responsável Técnico / Outros</h2>
       </div><!-- titulo --> 
      <div id="formulario_cinco">
			
            <table width="100%" border="0" style="float:left;">
  <tr>
    <td width="50%">Santa Maria,____de______________de_____</td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <td width="50%" align="center">_______________________________________</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-size:12px;">Assinatura do Responsável</td>
  </tr>
</table>

            
      </div><!-- formulario -->
    </div><!-- conteudo cinco -->
    
    <div id="conteudo_seis">
<div class="titulo">
 <h1>Uso pela Prefeitura Municipal</h1>
       </div><!-- titulo --> 
      <div id="formulario_seis">
		<table width="100%" height="100%" class="tabela">
  <tr align="center">
    <td colspan="3" height="20%" ><strong>Meio Ambiente</strong></td>
    <td colspan="3"><strong>Alvar&aacute; Sanit&aacute;rio</strong></td>
    <td><strong>C&oacute;digo Rua</strong></td>
    <td><strong>C&oacute;digo &Aacute;rea</strong></td>
  </tr>
  <tr align="center">
    <td height="20%">Cadastro</td>
    <td>Atividade</td>
    <td>&Aacute;rea</td>
    <td>Grupo</td>
    <td>Subgrupo</td>
    <td>C&oacute;digo</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="20%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr align="center">
    <td height="40%"><p><strong>Inscri&ccedil;&atilde;o</strong></p>
      <p><strong>do Iss:</strong></p></td>
    <td colspan="2">&nbsp;</td>
    <td><p><strong>Incri&ccedil;&atilde;o </strong></p>
      <p><strong>do Alvar&aacute;</strong></p></td>
    <td colspan="2">&nbsp;</td>
    <td><strong>N&deg; da Vistoria:</strong></td>
    <td>&nbsp;</td>
  </tr>
</table>
      </div><!-- formulario -->
    </div><!-- conteudo seis -->
    
    <div id="conteudo_sete">
      <div id="formulario_sete">
		 <table width="100%" height="100%" class="tabela">
  <tr>
    <td width="26%" valign="top"><p>Secretaria Administratica</p><span class="sub_titulo" >PROTOCOLO</span></td>
    <td width="33%" valign="top"><p>Secretaria Finanças</p><span class="sub_titulo2">DÍVIDA</span></td>
    <td width="41%" valign="top"><h2><strong>Alvará Retirado em ___/___/_____</strong></h2> 
    <h4>C.I.____________________________________</h4>
    <h4>NOME:_________________________________</h4>
    <h4>Ass.:___________________________________</h4></td>
  </tr>
  </table>
      </div><!-- formulario -->
    </div><!-- conteudo sete -->
   

    </div><!-- box -->

</div><!-- geral -->
</body>
</html>