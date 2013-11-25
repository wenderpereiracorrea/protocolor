<?php

////////////////////////////////////////////////////////////////////////

//  Tradução e adaptação: http://www.phpdemos.com.br       //

//  Pagination   V 1.1                                                        //

//                                                                                 //

//  A set of pagination functions for your website results pages      //

//                                                                    //

//  Copyright The pixelbox homepage.com 25/1/2007                     //

//                                                                    //

//  This program is free software; you can redistribute it and/or     //

//  modify it under the terms of the GNU General Public License       //

//  as published by the Free Software Foundation; either version 2    //

//  of the License, or (at your option) any later version.            //

//                                                                    //

//  This program is distributed in the hope that it will be useful,   //

//  but WITHOUT ANY WARRANTY; without even the implied warranty of    //

//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the     //

//  GNU General Public License for more details.                      //

//                                                                    //

//  You should have received a copy of the GNU General Public License //

//  along with this program; if not, write to the Free Software       //

//  Foundation, Inc., 51 Franklin Street, Fifth Floor,                //

//  Boston, MA  02110-1301, USA.                                      //

//                                                                    //

////////////////////////////////////////////////////////////////////////



// inclui a página com as funções

include_once('pagination.php');



///////////////////////////////////////////////////////////////////////////////////////

// INICIA CONEXÃO COM O BANCO

// conecata ao banco de dados



$localhost  = "192.168.1.242";

$username   = "dba";

$password   = "qmerda";

$database   = "protocolo";



$connection = mysql_connect($localhost,$username,$password)

              or die(mysql_error());



if($connection){

    mysql_select_db($database,$connection)

    or die(mysql_error());

        }else{

    echo "Nao conectei ao banco de dados";

     }

?>

<html>

  <head>

    <link rel="stylesheet" type="text/css" href="stylesheet.css">

  </head>

<body>

<?php



// Linhas de dados por pagina

     $entries_per_page=10;

     $page = (isset($_GET['page'])?$_GET['page']:1);



     $result     = mysql_query("SELECT COUNT(*) from processo ")

            or die (mysql_error());            

         $num_rows = mysql_fetch_row($result);



if($num_rows[0]!=0){

    $total_pages = ceil($num_rows[0]/$entries_per_page);    

    $pagination = pagination_six($total_pages,$page);

    $offset = (($page * $entries_per_page) - $entries_per_page);

    

 

    $result = mysql_query("SELECT * from processo LIMIT $offset,$entries_per_page")

              or die (mysql_error());



//    echo $pagination; // Mostra a paginação na parte superior

    

 ///////////// INICIA A TABELA DE EXEMPLO DE MOSTRA DOS DADOS   

    echo '<br /><center><table width="80%">

              <tr bgcolor="CCCCCC">

                <td><b>Autor</b></td>

                <td><b>Titulo</b</td>

              </tr>';

    

        // Looping para os resultados

    for($i=0;$row=mysql_fetch_assoc($result);$i++){

        echo "<tr>

                <td><a href='../../artigo.php?aux=$row[nprocesso]' target='_parent'>{$row['nprocesso']}</a></td>

                <td><a href='../../artigo.php?aux=$row[nprocesso]' target='_parent'>{$row['assunto']}</a></td>

              </tr>";

    }

    echo '</tr>

        </table></center>';

        

////////// TERMINA A TABELA DE EXEMPLO DE MOSTRAGEM DE DADOS       

    

    echo $pagination; // Mostra a página na parte inferior

                   

           }  // FECHA CHAVE DO IF QUE VERIFICA SE $num_rows[0] != 0

         ?>
</body>

</html>

