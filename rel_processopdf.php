<?php

define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");

// Conexao

$conn = mysql_connect("192.168.1.243","root","");
//$conn = mysql_connect("127.0.0.1","root","qwerty");
$banco = mysql_select_db("protocolo");
$datadoc = date("d-m-Y");

//include("conexao.php");

//$busca = mysql_query("select * from processo order by processo");

$busca = mysql_query("select nprocesso, procedencia, date_format(datadoc, '%d/%m/%Y') as 'datadoc', favorecido, assunto, anexos from processo order by processo");


// Variaveis de Tamanho

$mesq = "30"; // Margem Esquerda (mm)
$mdir = "30"; // Margem Direita (mm)
$msup = "15"; // Margem Superior (mm)
$leti = "100"; // Largura da Etiqueta (mm)
$aeti = "55"; // Altura da Etiqueta (mm)
$ehet = "2"; // Espaзo horizontal entre as Etiquetas (mm)

$pdf=new FPDF('P','mm','A4'); // Cria um arquivo novo com tamanho tipo carta
$pdf->Open(); // inicia documento
$pdf->AddPage(); // adiciona a primeira pagina
$pdf->SetMargins('7','10'); // Define as margens do documento
$pdf->SetAuthor("DINFO"); // Define o autor
$pdf->SetFont('Arial','',8); // Define a fonte
//$pdf->SetDisplayMode();

// Variaveis pro Loop

$coluna = 0;
$linha = 0;


//MONTA A ARRAY PARA ETIQUETAS
while($dados = mysql_fetch_array($busca)) {
$refprocesso = $dados["nprocesso"];
$procedencia = $dados['procedencia'];
$datadoc = $dados["datadoc"];
$favorecido = $dados["favorecido"];
$assunto = $dados["assunto"];
$anexos = $dados["anexos"];

	  
$lnprocesso = "PROCESSO: " . $refprocesso . " - " . $procedencia . " - " . $datadoc;
$lninteressado = "INTERESSADO: " . $favorecido;
$lnassunto = "ASSUNTO: " . $assunto;
$lnanexos = "ANEXOS: " . $anexos;

if($coluna == "1") { // Se for a terceira coluna
$coluna = 0; // $coluna volta para o valor inicial
$linha = $linha +1; // $linha й igual ela mesma +1
}

if($linha == "1") { // Se for a ъltima linha da pбgina
$pdf->AddPage(); // Adiciona uma nova pбgina
$linha = 0; // $linha volta ao seu valor inicial
}

$posicaoV = $linha*$aeti;
$posicaoH = $coluna*$leti;

if($coluna == "0") { // Se a coluna for 0
$somaH = $mesq; // Soma Horizontal й apenas a margem da esquerda inicial
} else { // Senгo
$somaH = $mesq+$posicaoH; // Soma Horizontal й a margem inicial mais a posiзгoH
}

if($linha =="0") { // Se a linha for 0
$somaV = $msup; // Soma Vertical й apenas a margem superior inicial
} else { // Senгo
$somaV = $msup+$posicaoV; // Soma Vertical й a margem superior inicial mais a posiзгoV
}

//$pdf->MultiCell(100, 5.5, $lnprocesso.$lninteressado.$lnassunto.$lnanexos); // Imprime a localidade da pessoa de acordo com as coordenadas

$pdf->Text($somaH,$somaV,$lnprocesso); // Imprime o nome da pessoa de acordo com as coordenadas

$pdf->Text($somaH,$somaV+8,$lninteressado); // Imprime o endereзo da pessoa de acordo com as coordenadas

$pdf->Text($somaH,$somaV+16,$lnassunto); // Imprime a localidade da pessoa de acordo com as coordenadas

$pdf->Text($somaH,$somaV+24,$lnanexos); // Imprime o cep da pessoa de acordo com as coordenadas */

$coluna = $coluna+1;
}


$pdf->Output(); // encerra o arquivo PDF
?>