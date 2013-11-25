function Mascara(formato, keypress, objeto){
campo = eval (objeto);

// cep
if (formato=='cep'){
	separador = '-';
	conjunto1 = 5;
if (campo.value.length == conjunto1){
	campo.value = campo.value + separador;}
}

// cpf
if (formato=='cpf'){
	separador1 = '.'; 
	separador2 = '-'; 
	conjunto1 = 3;
	conjunto2 = 7;
	conjunto3 = 11;
if (campo.value.length == conjunto1)
  {
  campo.value = campo.value + separador1;
  }
if (campo.value.length == conjunto2)
  {
  campo.value = campo.value + separador1;
  }
if (campo.value.length == conjunto3)
  {
  campo.value = campo.value + separador2;
  }
}

// CNPJ
if (formato=='cnpj'){
	separador1 = '.'; 
	separador2 = '.'; 
	separador3 = '/';
	separador4 = '-';
		conjunto1 = 2;
		conjunto2 = 6;
		conjunto3 = 10;
		conjunto4 = 15;
if (campo.value.length == conjunto1)
  {
  campo.value = campo.value + separador1;
  }
if (campo.value.length == conjunto2)
  {
  campo.value = campo.value + separador1;
  }
if (campo.value.length == conjunto3)
  {
  campo.value = campo.value + separador3;
  }
  if (campo.value.length == conjunto4)
  {
  campo.value = campo.value + separador4;
  }
}

// nascimento
if (formato=='nascimento'){
	separador = '/'; 
	conjunto1 = 2;
	conjunto2 = 5;
if (campo.value.length == conjunto1)
  {
  campo.value = campo.value + separador;
  }
if (campo.value.length == conjunto2)
  {
  campo.value = campo.value + separador;
  }
}
// dataexp
if (formato=='dataexp'){
	separador = '/'; 
	conjunto1 = 2;
	conjunto2 = 5;
if (campo.value.length == conjunto1)
  {
  campo.value = campo.value + separador;
  }
if (campo.value.length == conjunto2)
  {
  campo.value = campo.value + separador;
  }
}
// telefone
if (formato=='telefone'){

if (campo.value.length == 0)
campo.value = '(' + campo.value;

if (campo.value.length == 3)
campo.value = campo.value + ')';

if (campo.value.length == 8)
campo.value = campo.value + '-';

}


}

function SoNumero() {
	if (event.keyCode<48 || event.keyCode>57)
		event.returnValue = false;
	if (event.keyCode==13)
		event.returnValue = true;
}

//DESABILITA O ENTER ----------------------------------------------------------------------------
function handleEnter (field, event) {
        var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
        if (keyCode == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        }
        else
        return true;
    }      
//FIM DESABILITA O ENTER ------------------------------------------------------------------------
function send(codigo){
	document.form1.cod.value=codigo;
	document.form1.submit();
}
function validateEmail_(form_id,email) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = document.forms[form_id].elements[email].value;
   if(reg.test(address) == false) {
 
      alert('Email invalido');
      return false;
   }
}
//
//		function findCEP() {
//		    if($.trim($("#idFrmCep").val()) != ""){
//		        $("#ajax-loading").css('display','inline');
//				$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#idFrmCep").val().replace("-", ""), function(){
//		            if(resultadoCEP["resultado"] == 1){
//		                $("#idFrmEndereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
//		                $("#ifFrmMunicipio").val(unescape(resultadoCEP["bairro"]));
//		                $("#city").val(unescape(resultadoCEP["cidade"]));
//		                $("#cmbUnidadeFederativa").val(unescape(resultadoCEP["uf"]));
//		         //       $("#number").focus();
//		            }else{
//		                alert("Endereço não encontrado para o cep ");
//		            }
//		            $("#ajax-loading").hide();
//		        });
//		    }
//		}
//		$(document).ready(function(){
//		    $("#zipcode").mask("99999-999")
//		});


////http://www.geradorcnpj.com/javascript-validar-cnpj.htm
//function validarCNPJ(cnpj) {
// 
//    cnpj = cnpj.replace(/[^\d]+/g,'');
// 
//    if(cnpj == '') return false;
//     
//    if (cnpj.length != 14)
//        return false;
// 
//    // Elimina CNPJs invalidos conhecidos
//    if (cnpj == "00000000000000" || 
//        cnpj == "11111111111111" || 
//        cnpj == "22222222222222" || 
//        cnpj == "33333333333333" || 
//        cnpj == "44444444444444" || 
//        cnpj == "55555555555555" || 
//        cnpj == "66666666666666" || 
//        cnpj == "77777777777777" || 
//        cnpj == "88888888888888" || 
//        cnpj == "99999999999999")
//        return false;
//         
//    // Valida DVs
//    tamanho = cnpj.length - 2
//    numeros = cnpj.substring(0,tamanho);
//    digitos = cnpj.substring(tamanho);
//    soma = 0;
//    pos = tamanho - 7;
//    for (i = tamanho; i >= 1; i--) {
//      soma += numeros.charAt(tamanho - i) * pos--;
//      if (pos < 2)
//            pos = 9;
//    }
//    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
//    if (resultado != digitos.charAt(0))
//        return false;
//         
//    tamanho = tamanho + 1;
//    numeros = cnpj.substring(0,tamanho);
//    soma = 0;
//    pos = tamanho - 7;
//    for (i = tamanho; i >= 1; i--) {
//      soma += numeros.charAt(tamanho - i) * pos--;
//      if (pos < 2)
//            pos = 9;
//    }
//    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
//    if (resultado != digitos.charAt(1))
//          return false;
//           
//    return true;
//    
//}