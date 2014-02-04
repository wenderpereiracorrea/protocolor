// Script para a realiza��o da Busca Instantan�a com Ajax
// Por Leandro Vieira Pinho, colunista iMasters (Dreamweaver)

// Fun��o para iniciarmos o Ajax no browser do cliente.
function openAjax() {

var ajax;

try{
    ajax = new XMLHttpRequest(); // XMLHttpRequest para browsers decentes, como: Firefox, Safari, dentre outros.
}catch(ee){
    try{
        ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
    }catch(e){
        try{
            ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
        }catch(E){
            ajax = false;
        }
    }
}
return ajax;
}

// Fun��o que realiza a busca instant�nea
function buscaInstantanea() {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var termo = document.getElementById('q').value; // Pega o termo digitado no campo de texto.
		var exibeResultado = document.getElementById('resultadoBusca'); // div que exibir� o resultado da busca.
		if(termo !== "" && termo !== null && termo.length >= 0) { // Verifica se o campo n�o est� vazio, ou se foi digitado no m�nimo tr�s caracteres.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "buscaEspecie.php?q=" + termo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 1) { // Quando estiver carregando, exibe: carregando...
					//exibeResultado.innerHTML = "<h2>carregando...</h2>";
				}
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						resultado = resultado.replace(/\+/g," "); // Resolve o problema dos acentos (saiba mais aqui: http://www.plugsites.net/leandro/?p=4)
						resultado = unescape(resultado); // Resolve o problema dos acentos
						exibeResultado.innerHTML = resultado;
					} else {
						exibeResultado.innerHTML = "Erro: ";
					}
				}
			}
			ajax.send(null); // submete
		} 
	}
}	