<?php

define('FPDF_FONTPATH','fpdf/font/');
require("fpdf/fpdf.php");

// Conexao

$conn = mysql_connect("192.168.1.20","funarte","Funarte10");
$banco = mysql_select_db("ceav");

//include("conexao.php");

$busca = mysql_query("select * from bibliotecas");

// Variaveis de Tamanho

$mesq = "13"; // Margem Esquerda (mm)
$mdir = "13"; // Margem Direita (mm)
$msup = "3"; // Margem Superior (mm)
$leti = "82"; // Largura da Etiqueta (mm)
$aeti = "24"; // Altura da Etiqueta (mm)
$ehet = "3"; // Espa�o horizontal entre as Etiquetas (mm)

$pdf=new FPDF('P','mm','letter'); // Cria um arquivo novo com tamanho tipo carta
$pdf->Open(); // inicia documento
$pdf->AddPage(); // adiciona a primeira pagina
$pdf->SetMargins('6.8','10'); // Define as margens do documento
$pdf->SetAuthor("DINFO"); // Define o autor
$pdf->SetFont('Arial','',9); // Define a fonte
//$pdf->SetDisplayMode();

// Variaveis pro Loop

$coluna = 0;
$linha = 0;


//MONTA A ARRAY PARA ETIQUETAS
while($dados = mysql_fetch_array($busca)) {
$NUM = $dados["cod"];
$biblioteca = $dados["biblioteca"];
$nome = $dados["nome"];
$logradouro = $dados["logradouro"];
$bairro = $dados["bairro"];
$cidade = $dados["cidade"];
$cep = $dados["cep"];
	  
//$local = $municipio . " - " . $uf;
//$cep = "CEP: " . $dados["cep"];
//for ($i = 0; $i < 4; $i++) {

if($coluna == "4") { // Se for a terceira coluna
$coluna = 0; // $coluna volta para o valor inicial
$linha = $linha +1; // $linha � igual ela mesma +1
}

if($linha == "20") { // Se for a �ltima linha da p�gina
$pdf->AddPage(); // Adiciona uma nova p�gina
$linha = 0; // $linha volta ao seu valor inicial
}

$posicaoV = $linha*$aeti;
$posicaoH = $coluna*$leti;

if($coluna == "0") { // Se a coluna for 0
$somaH = $mesq; // Soma Horizontal � apenas a margem da esquerda inicial
} else { // Sen�o
$somaH = $mesq+$posicaoH; // Soma Horizontal � a margem inicial mais a posi��oH
}

if($linha =="0") { // Se a linha for 0
$somaV = $msup; // Soma Vertical � apenas a margem superior inicial
} else { // Sen�o
$somaV = $msup+$posicaoV; // Soma Vertical � a margem superior inicial mais a posi��oV
}

$pdf->Text($somaH,$somaV,$biblioteca); // Imprime o nome da pessoa de acordo com as coordenadas
$pdf->Text($somaH,$somaV+4,$nome); // Imprime o endere�o da pessoa de acordo com as coordenadas
$pdf->Text($somaH,$somaV+8,$logradouro); // Imprime a localidade da pessoa de acordo com as coordenadas
$pdf->Text($somaH,$somaV+12,$bairro); // Imprime o cep da pessoa de acordo com as coordenadas
$coluna = $coluna+1;
}


//}


$pdf->Output(); // encerra o arquivo PDF
?>