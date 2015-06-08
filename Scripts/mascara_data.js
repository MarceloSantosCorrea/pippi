
function mascaraData(campoData)
{
        var usuario_fone_resid = campoData.value;
        if(usuario_fone_resid.length == 0)
        {
                usuario_fone_resid += '(';
                document.forms[0].usuario_fone_resid.value = usuario_fone_resid;
                return true;
        }
        if(usuario_fone_resid.length == 3)
        {
                usuario_fone_resid += ') ';
                document.forms[0].usuario_fone_resid.value = usuario_fone_resid;
                return true;
        }
		if(usuario_fone_resid.length == 9)
        {
                usuario_fone_resid += '-';
                document.forms[0].usuario_fone_resid.value = usuario_fone_resid;
                return true;
        }
		

        
}
        function mascaraCelular(campoData)
        {
        var usuario_fone_cel = campoData.value;
        if(usuario_fone_cel.length == 0)
        {
                usuario_fone_cel += '(';
                document.forms[0].usuario_fone_cel.value = usuario_fone_cel;
                return true;
        }
        if(usuario_fone_cel.length == 3)
        {
                usuario_fone_cel += ') ';
                document.forms[0].usuario_fone_cel.value = usuario_fone_cel;
                return true;
        }
		if(usuario_fone_cel.length == 9)
        {
                usuario_fone_cel += '-';
                document.forms[0].usuario_fone_cel.value = usuario_fone_cel;
                return true;
        }
		
		
		
}

function mascaraFone(campoData)
        {
        var tecnicoFone2 = campoData.value;
        if(tecnicoFone2.length == 0)
        {
                tecnicoFone2 += '(';
                document.forms[0].tecnicoFone2.value = tecnicoFone2;
                return true;
        }
        if(tecnicoFone2.length == 3)
        {
                tecnicoFone2 += ') ';
                document.forms[0].tecnicoFone2.value = tecnicoFone2;
                return true;
        }
		if(tecnicoFone2.length == 9)
        {
                tecnicoFone2 += '-';
                document.forms[0].tecnicoFone2.value = tecnicoFone2;
                return true;
        }
		
		
		
}
function mascaraData(campoData)
        {
        var data = campoData.value;
        if(data.length == 2)
        {
                data += '/';
                document.forms[0].data.value = data;
                return true;
        }
        if(data.length == 5)
        {
                data += '/';
                document.forms[0].data.value = data;
                return true;
        }
		
		
		
		
}
        

//<input type="text" name="data" onKeyUp="mascaraData(this);" maxlength="10">
