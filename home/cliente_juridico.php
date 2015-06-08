
<script src="Scripts/jquery.js" type="text/javascript"></script>
<script src="Scripts/validaCpf.js" type="text/javascript"></script>
<script src="Scripts/validaCnpj.js" type="text/javascript"></script>
<table width="100%" border="0" class="tabela2">
    <form name="visualizar_cadastro_juridico" action="painel.php?exe=home/editar_juridico&amp;id=<?php echo $id_cliente;?>" method="post">
  <tr>
   <input type="hidden" name="id" value="<?php echo $id_cliente;?>" />
    <td width="17%" height="10%">Raz&atilde;o Social:</td>
    <td width="28%"><input type="text" name="razao" id="razao" value="<?php echo $razao;?>" disabled="disabled"></td>
    <td width="17%">Cnpj:</td>
    <td width="28%"><input type="text" name="cnpj" id="cnpj" value="<?php echo $cnpj;?>" disabled="disabled"></td>
  </tr>
  <tr>
  	<td width="17%" height="10%">Nome Fantasia:</td>
    <td width="28%"><input type="text" name="fantasia" id="fantasia" value="<?php echo $fantasia;?>" disabled="disabled"></td>
    <td width="17%">Incri&ccedil;&atilde;o Estadual:</td>
    <td width="28%"><input type="text" name="insc_estadual" id="insc_estadual" value="<?php echo $insc_estadual;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Endere&ccedil;o:</td>
    <td><input type="text" name="endereco_juridico" id="endereco_juridico" value="<?php echo $endereco;?>" disabled="disabled"></td>
    <td>N&deg;</td>
    <td><input type="text" name="num_endereco_juridico" id="num_endereco_juridico" value="<?php echo $num_endereco;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Bairro:</td>
    <td><input type="text" name="bairro_juridico" id="bairro_juridico" value="<?php echo $bairro;?>" disabled="disabled"></td>
    <td>Complemento:</td>
    <td><input type="text" name="compl_endereco_juridico" id="compl_endereco_juridico" value="<?php echo $compl_endereco;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Refer&ecirc;ncia:</td>
    <td><input type="text" name="ref_endereco_juridico" id="ref_endereco_juridico" value="<?php echo $ref_endereco;?>" disabled="disabled"></td>
    <td>Cep:</td>
    <td><input type="text" name="cep_juridico" id="cep_juridico" value="<?php echo $cep;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Cidade:</td>
    <td><input type="text" name="cidade_juridico" id="cidade_juridico" value="<?php echo $cidade;?>" disabled="disabled"></td>
    <td>Estado:</td>
    <td><input type="text" name="estado_juridico" id="estado_juridico" value="<?php echo $estado;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Telefone:</td>
    <td><input type="text" name="fone_resid_juridico" id="fone_resid_juridico" value="<?php echo $fone_resid;?>" disabled="disabled"></td>
    <td>Cel:</td>
    <td><input type="text" name="fone_cel_juridico" id="fone_cel_juridico" value="<?php echo $fone_cel;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">E-mail:</td>
    <td><input type="text" name="email_juridico" id="email_juridico" value="<?php echo $email;?>" disabled="disabled"></td>
    <td>CPF Responsável:</td>
    <td><input type="text" name="cpf_responsavel" id="aniversario_juridico" value="<?php echo $cpf_responsavel;?>" disabled="disabled" onkeypress="mascara(this,cpf)" maxlength="14" onblur="validarCpf(this)"></td>
  </tr>
  <tr>
    <td height="10%">Data Cadastro:</td>
    <td><input type="text" value="<?php echo date('d/m/Y H:i', strtotime($data_cadastro));?>"  disabled="disabled"></td>
    <td>Últ. Modificação:</td>
    <td><input type="text" value="<?php echo date('d/m/Y H:i', strtotime($data_modificado));?>" disabled="disabled" ></td>
  </tr>
  <tr>
    <td height="10%">Cadastrado Por:</td>
    <td><input type="text" value="<?php echo $cadastrado_por;?>" disabled="disabled" /></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="salvar_juridico" value="Salvar" class="btn" />
		<input type="submit" name="deletar" id="deletar" value="Excluir" class="btn"/>
        <input type="button" name="editar" id="editar" value="Editar" class="btn" />
    </td>
  </tr>
  </form>
          </table>