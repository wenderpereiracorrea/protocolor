<?php header("Content-type: text/html; charset=UTF-8");?> 
<?php
session_start();
//CONFIGURA��ES DO BD MYSQL FUNARTE
$servidor = "192.168.1.243"; 
$usuario = "root"; 
$senha = ""; 
$bd = "protocolo"; 
$data = date("d-m-Y");
/*
//CONFIGURA��ES DO BD MYSQL CASA
$servidor = "127.0.0.1"; 
$usuario = "root"; 
$senha = "qwerty"; 
$bd = "patrimonio"; 
$data = date("d-m-Y");
*/
//T�TULO DO RELAT�RIO 
$titulo = "Relat�rio de Devolu��o"; 
//LOGO QUE SER� COLOCADO NO RELAT�RIO 
$imagem = "rel_termo.png"; 

//ENDERE�O DA BIBLIOTECA FPDF 
//$end_fpdf = "c:/pagina/biblioteca/fpdf"; 
//NUMERO DE RESULTADOS POR P�GINA 
$por_pagina = 27; 
//ENDERE�O ONDE SER� GERADO O PDF 
//$end_final = "c:/pagina/imasters/110/artigo_php.pdf"; 
//TIPO DO PDF GERADO 
//F-> SALVA NO ENDERE�O ESPECIFICADO NA VAR END_FINAL 
$tipo_pdf = "F"; 

/************** N�O MEXER DAQUI PRA BAIXO ***************/ 

//CONECTA COM O MYSQL
$conn = mysql_connect($servidor, $usuario, $senha);
$db = mysql_select_db($bd, $conn); 

	//$sql = "select * from setores S,  produto P";
//	$sql = $sql." where P.localizacao = S.setor";
//	$sql = $sql." and responsavel = '".$responsavel."'";
//	$process = mysql_query($sql) or die("Erro: " . mysql_error());
//	mysql_free_result($process);	
//
//	$sql2="select count(P.tombanterior) as total,sum(P.valor) as soma from setores S, produto P";
//	$sql2 = $sql2." where P.localizacao = S.setor";
//	$sql2 = $sql2." and responsavel = '".$responsavel."'";
//	$process1 = mysql_query($sql2) or die("Erro: " . mysql_error());
//	mysql_free_result($process1);	
//	
//$sql = mysql_query($sql, $conn);
//$row = mysql_num_rows($sql); 
//
//$sql2 = mysql_query($sql2, $conn);
//$row2 = mysql_num_rows($sql2);

//VERIFICA SE RETORNOU ALGUMA LINHA
if(!$row) { echo "N�o retornou nenhum registro"; die; } 

//CALCULA QUANTAS P�GINAS V�O SER NECESS�RIAS
$paginas = ceil(1); 

//PREPARA PARA GERAR O PDF
define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");
$pdf = new FPDF( 'L','cm','A4' ); 
//margens laterais e superior
$pdf -> SetMargins(1.5, 1.5, 1.5);

//INICIALIZA AS VARI�VEIS
$linha_atual = 0;
$inicio = 0; 

//P�GINAS
for($x=1; $x<=$paginas; $x++) { 

//VERIFICA
$fim2 = $row;
$inicio = $linha_atual;
$fim = $linha_atual + $por_pagina;
if($fim > $row) $fim = $row;

$pdf->Open(); 
$pdf->AddPage(); 
$pdf->SetFont("Arial", "B", 10); 
//$pdf->Image($imagem, 0, 8);
$pdf->Cell(1, 1, $pdf->Image('imagebox/rel_termo.png', 2, 1,20));  
//$pdf->Cell(0,1,'http://www.seusite.com.br',0,1,'C');
//$pdf->Cell(0,1,'Eu, $nome, $cargo, declaramos pelo presente documento que recebi da Divis�o de Patrim�nio - FUNARTE, o material abaixo discriminado, pelo(s) qual(is) passo a ser respons�vel:',0,1,'L');
//$pdf->Cell(0,1,'http://www.seusite.com.br',0,1,'C');
//$pdf->Write(0.8,'Eu, $responsavel, $cargo, 
$pdf->Cell(25.7, 0.5, $data, 0, 0, 'R'); 

$pdf->Ln(0.4); 

//$pdf->Ln();
//$pdf->Cell(26, 0.4, "P�gina $x de $paginas", 0, 0, 'R'); 

//QUEBRA DE LINHA
$pdf->Ln(); 

//MONTA O O NRO PROCESSO, DEPOIS TEM Q PEGAR A VARI�VEL NPROCESSO 
$pdf->SetTextColor(0); 
$pdf->Cell(0, 0.7, "Processo: "); 
$pdf->Ln(); 

//MONTA O CABE�ALHO DO TEXTO, TEM Q VER A POSI��O DO TEXTO NA FOLHA
$pdf->SetTextColor(0); 
$pdf->Cell(0, 2.7, "� Coordena��o Financeira,"); 
$pdf->Ln();

//MONTA O TEXTO INTERNO, FALTA POSICION�-LO, ISSO S� TESTANDO
$pdf->SetTextColor(0); 
$pdf->Cell(0, 5.7, "Em devolu��o,"); 
$pdf->Ln();

//MONTA O TEXTO INTERNO, FALTA POSICION�-LO, ISSO S� TESTANDO, FALTA TB COLOCAR VARI�VEL
$pdf->SetTextColor(0); 
$pdf->Cell(0, 5.7, "Em"); 
$pdf->Ln();

//MONTA O TEXTO INTERNO, FALTA POSICION�-LO, ISSO S� TESTANDO, FALTA TB COLOCAR VARI�VEL
$pdf->SetTextColor(0); 
$pdf->Cell(0, 6.7, "Anagilsa Barbosa da N�brega Franco"); 
$pdf->Cell(0, 7.7, "Coordena��o-Geral de Planejamento e Administra��o"); 
$pdf->Ln();

//MONTA O CABE�ALHO 
//$pdf->SetTextColor(255); 
//$pdf->Cell(0, 0.5, "RESPONS�VEL", 1, 0, 'L', 1); 
//$pdf->SetX(15);
//$pdf->Cell(0, 0.5, "CARGO", 1, 1, 'L', 1); 

//EXIBE OS REGISTROS 
//if($fim < $row);
//$pdf->SetTextColor(0); 
//$pdf->Cell(0, 0.5, mysql_result($sql, $p, "responsavel"), 1, 0, 'L', 0); 
//$pdf->SetX(15);
//$pdf->Cell(0, 0.5, mysql_result($sql, $p, "cargo"), 1, 1, 'L', 0); 
//$linha_atual++;
//$pdf->Ln(); 

//MONTA O CABE�ALHO 
//$pdf->SetTextColor(255); 
//$pdf->Cell(0, 0.5, "REFER�NCIA", 1, 0, 'L', 1); 
//$pdf->SetX(5);
//$pdf->Cell(0, 0.5, "DESCRI��O DO MATERIAL", 1, 0, 'L', 1); 
//$pdf->SetX(22);
//$pdf->Cell(0, 0.5, "VALOR R$", 1, 0, 'L', 1); 
//$pdf->SetX(26);
//$pdf->Cell(0, 0.5, "ESTADO", 1, 1, 'L', 1); 

//EXIBE OS REGISTROS 
//for($i=$inicio; $i<$fim2; $i++) {
//$pdf->SetTextColor(0); 
//$pdf->Cell(0, 0.5, mysql_result($sql, $i, "tombanterior"), 1, 0, 'L', 0); 
//$pdf->SetX(5);
//$pdf->Cell(0, 0.5, mysql_result($sql, $i, "P.descricao"), 1, 0, 'L', 0); 
//$pdf->SetX(22);
//$pdf->Cell(0, 0.5, number_format(mysql_result($sql, $i, "valor"), 2, ',', '.'), 1, 0, 'L', 0); 
//$pdf->SetX(26);
//$pdf->Cell(0, 0.5, mysql_result($sql, $i, "estado"), 1, 1, 'L', 0); 
//$linha_atual++;
//}//FECHA FOR(REGISTROS - i)
//}//FECHA FOR(PAGINAS - x) 

//CRIA CABE�ALHO DO TOTAL
//if($fim < $row2);//VERIFICA SE � FIM DO REGISTRO (LINHAS DO SQL)
//$pdf->Ln(); //PULA UMA LINHA (SE N�O ESCREVER NADA ENTRE PARENTES, O N� 1 DEFAULTs)
//$pdf->SetTextColor(255);//PARA ESCREVER O CABE�ALHO 
//$pdf->SetX(20);
//$pdf->Cell(0, 0.5, "ITENS", 1, 0, 'L', 1); 
//$pdf->SetX(24);
//$pdf->Cell(0, 0.5, "TOTAL R$", 1, 1, 'L', 1);

//MOSTRA O VALOR TOTAL DOS REGISTROS
//$pdf->SetTextColor(0); //PARA ESCREVER OS VALORES 
//$pdf->SetX(20);
//$pdf->Cell(0, 0.5, mysql_result($sql2, $j, "total"), 1, 0, 'L', 0); 
//$pdf->SetX(24);
//$pdf->Cell(0, 0.5, number_format(mysql_result($sql2, $j, "soma"), 2, ',', '.'), 1, 1, 'L', 0); 

//$pdf->Ln(); 
//$pdf->SetTextColor(0); 
//$pdf->MultiCell(0, 0.5, "IN. SEDAP N� 205 DE 08/04/1988:
//
//Todo Servidor P�blico poder� ser chamado � responsabilidade pelo desaparecimento do material que lhe for confiado, para guarda ou uso, bem como pelo dano que, dolosa ou culposamente, causar a qualquer material, esteja ou n�o sob sua guarda.
//
//										______/______/______    													                               ____________________________________________"); 



$pdf->Output();


?>