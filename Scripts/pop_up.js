function abrir(pagina,largura,altura) {

//pega a resolu��o do visitante
w = screen.width;
h = screen.height;

//divide a resolu��o por 2, obtendo o centro do monitor
meio_w = w/2;
meio_h = h/2;

//diminui o valor da metade da resolu��o pelo tamanho da janela, fazendo com q ela fique centralizada
altura2 = altura/2;
largura2 = largura/2;
meio1 = meio_h-altura2;
meio2 = meio_w-largura2;

//abre a nova janela, j� com a sua devida posi��o
window.open(pagina,'','height=' + altura + ', width=' + largura + ', top='+meio1+', left='+meio2+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}

