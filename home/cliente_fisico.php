<table width="100%" border="0" class="tabela2" >
    <form name="visualizar_cadastro_fisico" action="painel.php?exe=home/editar_fisico&amp;id=<?php echo $id_cliente; ?>" method="post">
  <tr>
  <input type="hidden" name="id" value="<?php echo $id_cliente;?>" />
    <td width="14%" height="10%">Nome:</td>
    <td width="39%" ><input type="text" name="nome" id="nome" value="<?php echo $nome;?>" disabled="disabled"></td>
    <td width="15%">Cpf:</td>
    <td width="32%"><input type="text" name="cpf" id="cpf" value="<?php echo $cpf;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td width="14%" height="10%">RG:</td>
    <td width="39%"><input type="text" name="rg" id="rg" value="<?php echo $rg;?>" disabled="disabled"></td>
    <td width="15%">Orgão Expeditor:</td>
    <td width="32%"><input type="text" name="orgao" id="orgao" value="<?php echo $orgao;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td width="14%" height="10%">UF:</td>
    <td width="39%"><input type="text" name="uf"  id="uf" value="<?php echo $uf;?>" disabled="disabled"></td>
    <td width="15%">Data Expedição:</td>
    <td width="32%"><input type="text" name="data_expedicao" id="data_expedicao" value="<?php echo $data_expedicao;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Endere&ccedil;o:</td>
    <td><input type="text" name="endereco" id="endereco" value="<?php echo $endereco;?>" disabled="disabled"></td>
    <td>N&deg;</td>
    <td><input type="text" name="num_endereco" id="num_endereco" value="<?php echo $num_endereco;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Bairro:</td>
    <td><input type="text" name="bairro" id="bairro" value="<?php echo $bairro;?>" disabled="disabled"></td>
    <td>Complemento:</td>
    <td><input type="text" name="compl_endereco" id="compl_endereco" value="<?php echo $compl_endereco;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Refer&ecirc;ncia:</td>
    <td><input type="text" name="ref_endereco" id="ref_endereco" value="<?php echo $ref_endereco;?>" disabled="disabled" ></td>
    <td>Cep:</td>
    <td><input type="text" name="cep" id="cep" value="<?php echo $cep;?>" disabled="disabled" ></td>
  </tr>
  <tr>
    <td height="10%">Cidade:</td>
    <td><input type="text" name="cidade" id="cidade" value="<?php echo $cidade;?>" disabled="disabled" ></td>
    <td>Estado:</td>
    <td><input type="text" name="estado" id="estado" value="<?php echo $estado;?>" disabled="disabled" ></td>
  </tr>
  <tr>
    <td height="10%">Telefone:</td>
    <td><input type="text" name="fone_resid" id="fone_resid" value="<?php echo $fone_resid;?>" disabled="disabled"></td>
    <td>Cel:</td>
    <td><input type="text" name="fone_cel" id="fone_cel" value="<?php echo $fone_cel;?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">E-mail:</td>
    <td><input type="text" name="email" id="email" value="<?php echo $email;?>" disabled="disabled"></td>
    <td>Data Anivers&aacute;rio:</td>
    <td><input type="text" name="aniversario" id="aniversario" value="<?php echo date('d/m/Y', strtotime($aniversario));?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td height="10%">Filia&ccedil;&atilde;o Pai:</td>
    <td><input type="text" name="pai" id="pai" value="<?php echo $cliente_pai;?>" disabled="disabled" /></td>
    <td>Filia&ccedil;&atilde;o M&atilde;e</td>
    <td><input type="text" name="mae" id="mae" value="<?php echo $cliente_mae;?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td height="10%">Cadastrado Por:</td>
    <td><input type="text" value="<?php echo $cadastrado_por;?>" disabled="disabled" /></td>
    <td>Data Cadastro:</td>
    <td><input type="text" name="data_cadastro" value="<?php echo date('d/m/Y H:i', strtotime($data_cadastro));?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td height="10%">&Uacute;lt. Modifica&ccedil;&atilde;o:</td>
    <td><input type="text" name="data_modificado" value="<?php echo date('d/m/Y H:i', strtotime($data_modificado));?>" disabled="disabled" /></td>
    <td></td>
    <td><input type="submit" name="salvar_fisico" value="Salvar" class="btn" />
      <input type="submit" onclick="painel.php?exe=home/excluir&amp;cliente=<?php echo $id_cliente;?>" name="deletar" id="deletar" value="Excluir" class="btn"/>
      <input type="button" name="editar" id="editar" value="Editar" class="btn" /></td>
  </tr>
  </form>
          </table>
          
          