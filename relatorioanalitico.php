<?
include "header.php";
include "conexao.php";
connect();
@session_start(); // Inicializa a sessão
?>
<?
$sql = "SELECT * FROM categoria
			";
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
$Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
while ($array_exibir = mysql_fetch_array($Resultado)) {
    $codcategoria = ($array_exibir['codcategoria']);
    $codgrupo = ($array_exibir['codgrupo']);
    $nomegrupo = ($array_exibir['nome']);
}
?>

<?php
$data_ano = date("Y");
$data_mes = date("m");
$data_dia = date("d");

?>
<?

function getArray1() {
    $sql = "select * from categoria";
    $Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
    $i = 0;
    $categoria = array();
    while ($array_exibir = mysql_fetch_array($Resultado)) {
        $categoria[$array_exibir['codgrupo']] = $array_exibir['nome'];
        $i++;
    }
    return $categoria;
}

$meuArray1 = getArray1();

?>
<!--=============================================================
        BUSCA AJAX
        =============================================================-->
<script	src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<!--=============================================================
        SCRIPT JQUEY VALIDATION
        =============================================================-->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
<link rel="stylesheet" href="css/template.css" type="text/css" />
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script	src="js/languages/jquery.validationEngine-pt_BR.js"	type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script	src="js/jsValidate.js" type="text/javascript"></script>
<!--=============================================================
        SCRIPT JQUEY VALIDATION
        =============================================================-->
<script>
    jQuery(document).ready(function() {  // binds form submission and fields to the validation engine
        jQuery("#form1").validationEngine();
    });
</script>
<form name="form1" id="form1" method="post" action="dao/usuarioinsert.php">
    <div class="container">
        <label><H5 align="center">SERVIÇO DE ADMINISTRAÇÃO DE SERVIÇOS GERAIS - SASG </H5></label> 
        <label><H5 align="center">RELÁTORIO DE MOVIMENTAÇÃO DE ALMOXARIFADO - RMA</H5></label> 
        <label><H5 align="center">RELÁTORIO ANALÍTICO</H5></label> 
        <label><H5>UNIDADE GESTORA: FUNDAÇÃO CASA DE RUI BARBOSA</H5></label> 
        <label><H5>CÓDIGO DA UNIDADE GESTORA: 344001</H5></label> 
		<label><H5>GESTÃO: 34201</H5></label>
        <label><H5>MÊS: <? if ($data_mes == 01){ echo "JANEIRO";}
						else if ($data_mes == 02){ echo "FEVEREIRO";}
						else if ($data_mes == 03){ echo "MARÇO";}
						else if ($data_mes == 04){ echo "ABRIL";}
						else if ($data_mes == 05){ echo "MAIO";}
						else if ($data_mes == 06){ echo "JUNHO";}
						else if ($data_mes == 07){ echo "JULHO";}
						else if ($data_mes == 08){ echo "AGOSTO";}
						else if ($data_mes == 09){ echo "SETEMBTO";}
						else if ($data_mes == 10){ echo "OUTUBRO";}
						else if ($data_mes == 11){ echo "NOVEMBRO";}						
						else if ($data_mes == 12){ echo "DEZEMBRO";}?></H5></label> 
        <label><H5>ANO: <? echo $data_ano; ?> </H5></label> 
    </div>
    <div class="container">
        <legend><!--<H4><i class="icon-shopping-cart"></i> Relátorio Analítico	</h4>--></legend>
        <?
        $sqlResultadoprodutospedido = "SELECT codgrupo, ( prevenda.quantidadeentrada * prevenda.preco) as saldo_anterior, 
                                        (pedmov.quantidade * prevenda.preco) as saida
									FROM 
									produto AS prod,
									categoria AS categ,sigen.pedido,
									pedidomovimentacao AS pedmov,
									pedido as pedid,
									precoproduto as prevenda
									WHERE
									prod.categoria_codcategoria = categ.codcategoria AND
									pedid.idpedido = pedmov.pedido_idpedido AND
									prod.idproduto = prevenda.produto_idproduto AND
									pedmov.precoproduto_idprecoproduto = prevenda.idprecoproduto
									GROUP BY codgrupo
									";
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');
        $Resultadoprodutospedido = mysql_query($sqlResultadoprodutospedido) or die("Erro: " . mysql_error());
        $totalconsult = mysql_num_rows($Resultadoprodutospedido);
        if ($totalconsult < 1) {
            ?>
            <!-- total de resultados da consulta -->
            <!--=============================================================
            JS
            =============================================================-->
        <? } elseif ($totalconsult >= 150) { ?>
            <div class="alert alert-block alert-error fade in">
                <? echo "FAVOR REFINAR A CONSULTA SOMENTE OS PRIMEIROS 150 ITENS SÃO EXIBIDOS" ?>
            </div>
			<table style="width: 100%; border: solid 1px #ddd;" class="table table-bordered" cellpadding="3" cellspacing="3">
                <tr>
                    <td style="background-color: #049cdb; color: #FFFFFF;"><b>ESPECIFICAÇÃO <br/>
                            33.90.30.00 - CONSUMO</b></td>
                    <td style="background-color: #049cdb; color: #FFFFFF;"><b>SALDO <br/> ANTERIOR</b></td>
                   <!-- <td style="background-color: #049cdb; color: #FFFFFF;"><b>ORÇAMENTARIA</b></td>
                    <td style="background-color: #049cdb; color: #FFFFFF;"><b>EXTRA <BR/>ORÇAMENTARIA</b></td>-->
                    <td style="background-color: #049cdb; color: #FFFFFF;"><b>SAÍDA</b></td> 
                    <td style="background-color: #049cdb; color: #FFFFFF;"><b>SALDO <BR/>ATUAL</td>

                    </td>
                </tr>
			<? } else { ?>
                <!--<span class="badge badge-info"><? echo "Total: $totalconsult" ?></span> -->
                <table style="width: 100%; border: solid 1px #ddd;"	class="table table-bordered" cellpadding="4" cellspacing="4">
                    <tr>
                        <td style="background-color: #049cdb; color: #FFFFFF;"><b>ESPECIFICAÇÃO <br/>
                                33.90.30.00 - CONSUMO</b></td>
                         <td style="background-color: #049cdb; color: #FFFFFF;"><b>SALDO <br/> ANTERIOR</b></td>
                       <!-- <td style="background-color: #049cdb; color: #FFFFFF;"><b>ORÇAMENTARIA</b></td>
                        <td style="background-color: #049cdb; color: #FFFFFF;"><b>EXTRA <BR/>ORÇAMENTARIA</b></td>-->
                        <td style="background-color: #049cdb; color: #FFFFFF;"><b>SAÍDA</b></td> 
                        <td style="background-color: #049cdb; color: #FFFFFF;"><b>SALDO <BR/>ATUAL</td>


                    </tr>
                <? } ?>
                <?
                while ($array_exibir = mysql_fetch_array($Resultadoprodutospedido)) {
                    $valprod = urlencode($array_exibir['codfornecedor'])
                    ?><!-- Inicio da formação dos links para exibir a consulta -->
                    <tr>
                        <td><label><?php echo $array_exibir['codgrupo'] ?></label>
						<?php $valor_anterior = ($array_exibir['saldo_anterior']); ?>
                        <td><label>R$ <?php echo number_format($valor_anterior, 2, ",", "."); ?></label>
                        <!-- <td><label><?php echo $array_exibir['tel'] ?></label>
                        <td><label><?php echo $array_exibir['cnpj'] ?></label> -->
                        <?php $valorsaida = ($array_exibir['saida']); ?>
                        <td><label>R$ <?php echo number_format($valorsaida, 2, ",", "."); ?></label>
						<? $saldo_atual = $valor_anterior - $valorsaida; ?>
						<td><label>R$ <?php echo number_format($saldo_atual, 2, ",", "."); ?></label>
                        <!-- <td><label><?php echo $array_exibir['email'] ?></label> -->
                    </tr>
					
					<? $totalsaida += $valorsaida ?>			
					<? $totalanterior += $valor_anterior ?>						
					<? $total_saldoatual += $saldo_atual ?>
                    <?
                    $i++;
				}
				?>	
					<tr>
						<td style="background-color: #049cdb; color: #FFFFFF;"><span><b>Total:  </span></td>
						<td style="background-color: #049cdb; color: #FFFFFF;"><span><b>R$<? echo number_format($totalanterior,2,",",".");?></span></td>
						<td style="background-color: #049cdb; color: #FFFFFF;"><span><b>R$<? echo number_format($totalsaida,2,",","."); ?></span></td>
						<td style="background-color: #049cdb; color: #FFFFFF;"><span><b>R$<? echo number_format($total_saldoatual,2,",","."); ?></span></td>
					</tr>
				
				</fieldset>
				</div>
                </div>
				<table>
				<h5>Rio de Janeiro, <? echo $data_dia ?> de <?if ($data_mes == 01){ echo "JANEIRO";}
						else if ($data_mes == 02){ echo "Fevereiro";}
						else if ($data_mes == 03){ echo "Março";}
						else if ($data_mes == 04){ echo "Abril";}
						else if ($data_mes == 05){ echo "Maio";}
						else if ($data_mes == 06){ echo "Junho";}
						else if ($data_mes == 07){ echo "Julho";}
						else if ($data_mes == 08){ echo "Agosto";}
						else if ($data_mes == 09){ echo "Setembro";}
						else if ($data_mes == 10){ echo "Outubro";}
						else if ($data_mes == 11){ echo "Novembro";}						
						else if ($data_mes == 12){ echo "Dezembro";} ?> de <? echo $data_ano ?>.</h5>
				<table>
				<table align="right">
				<tr>
				<td><h5>Valdemiro Martins Junior - Almoxarife Técnico </h5></td>
				</tr>
				<table>
				<script src="bootstrap/js/bootstrap-dropdown.js"></script>
                <script src="bootstrap/js/bootstrap-collapse.js"></script>
                </div>
                </div>
                <?// include "footer.php"  ?>
                </form>