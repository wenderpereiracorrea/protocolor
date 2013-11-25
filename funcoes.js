// JavaScript Document
//MÁSCARA DE VALORES

function txtBoxFormat(objeto, sMask, evtKeyPress) {
    var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;


if(document.all) { // Internet Explorer
    nTecla = evtKeyPress.keyCode;
} else if(document.layers) { // Nestcape
    nTecla = evtKeyPress.which;
} else {
    nTecla = evtKeyPress.which;
    if (nTecla == 8) {
        return true;
    }
}

    sValue = objeto.value;

    // Limpa todos os caracteres de formatação que
    // já estiverem no campo.
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( " ", "" );
    sValue = sValue.toString().replace( " ", "" );
    fldLen = sValue.length;
    mskLen = sMask.length;

    i = 0;
    nCount = 0;
    sCod = "";
    mskLen = fldLen;

    while (i <= mskLen) {
      bolMask = ((sMask.charAt(i) == "-") || (sMask.charAt(i) == ".") || (sMask.charAt(i) == "/") || (sMask.charAt(i) == ":"))
      bolMask = bolMask || ((sMask.charAt(i) == "(") || (sMask.charAt(i) == ")") || (sMask.charAt(i) == " "))

      if (bolMask) {
        sCod += sMask.charAt(i);
        mskLen++; }
      else {
        sCod += sValue.charAt(nCount);
        nCount++;
      }

      i++;
    }

    objeto.value = sCod;

    if (nTecla != 8) { // backspace
      if (sMask.charAt(i-1) == "9") { // apenas números...
        return ((nTecla > 47) && (nTecla < 58)); } 
      else { // qualquer caracter...
        return true;
      } 
    }
    else {
      return true;
    }
  }


function SoNumero() 
{
	if ((event.keycode!=13) && 
		(event.keyCode<45 || event.keyCode>57))
			event.returnValue = false;
}
function SoTexto() 
{
	if ((event.keycode!=13) && (event.keyCode<45 || event.keyCode>57)) 
	{ event.returnValue = true; } else { event.returnValue = false; }
}
function formatar(src, mask) 
{
	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida) 
	{
		src.value += texto.substring(0,1);
	}
}
VerifiqueTAB=true;
function Mostra(quem, tammax) {
    if ( (quem.value.length == tammax) && (VerifiqueTAB) ) {
        var i=0,j=0, indice=-1;
        for (i=0; i<document.forms.length; i++) {
            for (j=0; j<document.forms[i].elements.length; j++) {
                if (document.forms[i].elements[j].name == quem.name) {
                    indice=i;
                    break;
                }
            }
            if (indice != -1)
                 break;
        }
        for (i=0; i<=document.forms[indice].elements.length; i++) {
            if (document.forms[indice].elements[i].name == quem.name) {
                while ( (document.forms[indice].elements[(i+1)].type == "hidden") &&
                        (i < document.forms[indice].elements.length) ) {
                            i++;
                }
                document.forms[indice].elements[(i+1)].focus();
                VerifiqueTAB=false;
                break;
            }
        }
    }
}
function Focus(obj) {
	document.getElementById(obj.id).className = 'cor-ativa';
}
function Blur(obj) {
	document.getElementById(obj.id).className = 'cor-inativa';
}	 	
