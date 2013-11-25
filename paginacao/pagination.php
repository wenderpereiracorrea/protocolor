<?php
////////////////////////////////////////////////////////////////////////
//  Tradução e adaptação: http://www.phpdemos.com.br       //
//                                                                                 //
//                                                                                 //
//  Pagination   V 1.1                                                //
//                                                                    //
//  A set of pagination functions for your website results pages      //
//                                                                    //
//  Copyright The pixelbox homepage.com 13/10/2006                    //
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


////////////////////////CHANGELOG///////////////////////////////////////
//                                                                    //
//  version 1.0 released 13/10/2006                                   //
//                                                                    //
//  version 1.01 released 11/11/2006                                  //
//    fixed bug in pagination 4 when 11 links were presented          //
//                                                                    //
//  version 1.1 released 25/1/2007 - current version                  //
//    change function output to variable rather than echo             //
//    fixed output when total_pages =1;                               //
//    bug fixes for pagination three                                  //
////////////////////////////////////////////////////////////////////////


//
//    Para uso da paginação chame na função a variável total_pages e
//    a pagina como paramentros
//
//    exemplo. $pagination = pagination_one($total_pages,$page);
//
//    Use echo $pagination onde deseja mostrar a paginação 
// 
//    Veja o arquivo index.php para um exemplode uso
//
//    Use o banco SQL presente no ZIP para teste.
//
//    A link is not required if you use the methods though would be appreciated
//
//    <a href="http://www.thepixelboxhomepage.com">the pixelBOX homepage.com</a>  
//
//
/////////////////////////////////////////////////////////////////////////START


  // Nome do script;

$webpage = basename($_SERVER['PHP_SELF']);

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 1

function pagination_one($total_pages,$page){

    global $webpage;
    
        // Inicia a geração da $pagination
    
    $pagination='<div class="page_numbers">
                    <ul>';
      
        // Se houver mais de uma página como resultado
      
    if($total_pages!=1){
    
            // Faz um looping no total de paginas
    
        for ($i=1;$i<$total_pages+1;$i++){
        
                // se a pagina corrente não é um link
        
            if($i==$page){
                $pagination.='<li><a class="current">'.$i.'</a></li>
                ';
            }
            
                // caso contrário cria um link
            
            else{
                $pagination.='<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a></li>
                ';
            }
        }
        
    }
    
        // Se houver apenas uma pagina como resultado
    
    else{
        $pagination.='<li><a href="" class="current">1</a></li>';
    }
    
        // Finaliza e dá o resultado
    
    $pagination.='</ul>
            </div>';
            
    return($pagination);
}

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 2

function pagination_two($total_pages,$page){

    global $webpage;
    
    
    $pagination='<div class="page_numbers">
                    <ul>';
    
    
        //more than one page of results
    
    if($total_pages!=1){
    
        //if the current page is greater than one then provide link to prev and first
    
    if($page>'1'){
        $pagination.='<li class="current"><a href="'.$webpage.'?page=1">Inicio</a></li>
                      <li class="current"><a href="'.$webpage.'?page='.($page-1).'">Ant</a></li>
                      ';
    }
    
            //loop through to provide the links
    
        for ($i=1;$i<$total_pages+1;$i++){
        
                //if current page no link
        
            if($i==$page){
                $pagination.='<li><a class="current">'.$i.'</a></li>
                ';
            }
            
                //else provide a link
            
            else{
                $pagination.= '<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a></li>
                </li>';
            }
        }
        
            //if not the last page then provide link to the page
        
        if(($page >='1')&&($page!=$total_pages)){
            $pagination.='<li class="current"><a href="'.$webpage.'?page='.($page+1).'">Prox</a></li>
                         <li class="current"><a href="'.$webpage.'?page='.$total_pages.'">Final</a></li>
                        ';
        }
    }
    
        //if one page of results
    
    else{
        $pagination.='<li><a href="" class="current">1</a></li>';
    }
    
        //finish and return
   
    $pagination.='</ul>
              </div>';
    return($pagination);
}

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 3

function pagination_three($total_pages,$page){

    global $webpage;
    
        //start to build $pagination
    
    $pagination = '<div class="page_numbers">
                          <ul>';
   
        //if more than one page
   
    if($total_pages!=1){   
        
        //first and prev links        
        
        if($page>'1'){
        $pagination.='<li class="current"><a href="'.$webpage.'?page=1">Inicio</a></li>
                      <li class="current"><a href="'.$webpage.'?page='.($page-1).'">Ant</a></li>
                    ';
        }
        
        //$maximum_links is the starting maximum links on the page
    
        $maximum_links = 10;
        
          //if less pages than maximum links are to be needed
        
        if($total_pages<=$maximum_links){
        
                //set maximum links to the total pages
                // plus 1 for the loop
        
            $maximum_links = $total_pages+1;
        }
        
            //if more are needed
        
        else{
        
            //$maximum_links +1 for the loop
        
            $maximum_links=$maximum_links+1;
            
            
            //if the page is greater than maximum links then extend the loop by one
            
            if($page>=$maximum_links){
                $maximum_links=$page+1;
            }
        }
        
        //loop through
        
        for ($i=1;$i<$maximum_links;$i++){
        
                //if page then no link
        
            if($i==$page){
                $pagination.='<li><a class="current">'.$i.'</a></li>
                ';
            }   
            
                //else provide a link
            
            else{
                $pagination.= '<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a></li>
                ';
            }
        }
        
            //next and last links
        
        if(($page >="1")&&($page!=$total_pages)){
            $pagination.= '<li class="current"><a href="'.$webpage.'?page='.($page+1).'">Prox</a></li>
                            <li class="current"><a href="'.$webpage.'?page='.$total_pages.'">Final</a></li>
                          ';
        }
    
    }
    
        //if one page of results
    
    else{
        $pagination.='<li><a href="" class="current">1</a></li>';
    }
    
        //finish and return
    
    $pagination.='</ul>
              </div>';
    
    return($pagination);
    
}

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 4

function pagination_four($total_pages,$page){

    global $webpage;
  
    $pagination='<div class="page_numbers">
                  <ul>';
                  
        //if more than one page              
                  
    if($total_pages!=1){
    
        //change these for links per page
        //
        //  $max is the visible links
        // $shirt is the page the links start to shift on
        //
        // e.g. $max-$shirt+1 = shifting page
    
        $max = 10;
        $shift = 5;
        
        
        //used in the loop
        
        $max_links = $max+1;
        $h=1;  
        
            //if more pages than max links
        
        if($total_pages>=$max_links){
        
                //if page is greater than shifing page and the last page is not there
        
            if(($page>=$max_links-$shift)&&($page<=$total_pages-$shift)){  
            
                //set the loop values based on the current page
            
                $max_links = $page+$shift;
                $h=$max_links-$max;
            }
            
            //if the last link is visible then set the top of the loop to
            // the total_pages
            // otherwise we get links to pages with no results
            
            if($page>=$total_pages-$shift+1){
                $max_links = $total_pages+1;
                $h=$max_links-$max;
            } 
        }
        
        //if less pages than max links then set the top of the loop to total pages
        
        else{
            $h=1;
            $max_links = $total_pages+1;
        }

            //first and prev buttons
        if($page>'1'){
            $pagination.= '<li class="current"><a href="'.$webpage.'?page=1">Inicio</a></li>
                            <li class="current"><a href="'.$webpage.'?page='.($page-1).'">Ant</a></li>
                          ';
        }
        
        //loop through the results;
        
        for ($i=$h;$i<$max_links;$i++){
        
                //if current page no link
        
            if($i==$page){
                $pagination.='<li><a class="current">'.$i.'</a></li>
                              ';
            }
            
                //else provide a link
            
            else{
                $pagination.= '<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a></li>
                              ';
            }
        }
        //next and last buttons
        if(($page >='1')&&($page!=$total_pages)){
            $pagination.= '<li class="current"><a href="'.$webpage.'?page='.($page+1).'">Prox</a></li>
                          <li class="current"><a href="'.$webpage.'?page='.$total_pages.'">Final</a></li>
                          ';
        }
    }
    //one page of results
    else{
        $pagination.='<li><a href="" class="current">1</a></li>';
    }
    $pagination.='</ul>
              </div>';
    return($pagination);
}

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 5

function pagination_five($total_pages,$page){

    global $webpage;
    $pagination='<div class="page_numbers">
                  <ul>';

      //if more than one page of results

    if($total_pages!=1){
    
        //configure for the starting links per page
    
        $max = 10;
        
        //used in the loop
    
        $max_links = $max+1;
        $h=1;
        
            //if page is above max link
        
        if($page>$max_links){
        
            //start of loop 
        
            $h=(($h+$page)-$max_links);
        }
        
          //if page is not page one
        
        if($page>=1){
        
                //top of the loop extends
        
            $max_links = $max_links+($page-1);
        }
        
            //if the top page is visible then reset the top of the loop to the $total_pages
        
        if($max_links>$total_pages){
            $max_links=$total_pages+1;
        }
        
            //next and prev buttons
        
        if($page>'1'){
            $pagination.='<li class="current"><a href="'.$webpage.'?page=1">Inicio</a></li>
                        <li class="current"><a href="'.$webpage.'?page='.($page-1).'">Ant</a></li>
                        ';
        }
        
            // Cria a pagina de links
        
        for ($i=$h;$i<$max_links;$i++){
            if($i==$page){
                $pagination.='<li><a class="current">'.$i.'</a></li>';
            }
            else{
                $pagination.='<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a> </li>';
            }
        }
        
            // Botão Próxima e final
            
        if(($page >="1")&&($page!=$total_pages)){
            $pagination.='<li class="current"><a href="'.$webpage.'?page='.($page+1).'">Prox</a></li>
                          <li class="current"><a href="'.$webpage.'?page='.$total_pages.'">Final</a></li>
                          ';
        }
    }
    
    //if one page of results
    
    else{
        $pagination.='<li><a href="" class="current">1</a></li>';
    }
    $pagination.='</ul>
            </div>';
    return($pagination);
}

////////////////////////////////////////////////////////////
// MODELO DE PAGINAÇÃO 6

function pagination_six($total_pages,$page){

    global $webpage;

    $pagination = '<div class="page_numbers">
                    <ul>';
                    
    if($total_pages!=1){
    
        //the total links visible
          
        $max_links=10;
        
        
        //$max links_marker is the top of the loop
        //$h is the start
        
        $max_links_marker = $max_links+1;            
        $h=1;            
        
        
        //$link_block is the block of links on the page
        //When this is an integer we need a new block of links
                  
        $link_block=(($page-1)/$max_links);
        
        //if the page is greater than the top of th loop and link block
        //is an integer
        
        if(($page>=$max_links_marker)&&(is_int($link_block))){
        
                //reset the top of the loop to a new link block
        
            $max_links_marker=$page+$max_links;
            
                //and set the bottom of the loop         
            
            $h=$max_links_marker-$max_links;
            $prev=$h-1;                                                                    
        }
        
            //if not an integer we are still within a link block
        
        elseif(($page>=$max_links_marker)&&(!is_int($link_block))){
            
                //round up the link block
            
            $round_up=ceil($link_block);
                    
            $new_top_link = $round_up*$max_links;
            
                //and set the top of the loop to the top link
            
            $max_links_marker=$new_top_link+1;
            
                //and the bottom of the loop to the top - max links
            
            $h=$max_links_marker-$max_links;
            $prev=$h-1;                            
        }
        
          //if greater than total pages then set the top of the loop to
          // total_pages
        
        if($max_links_marker>$total_pages){
            $max_links_marker=$total_pages+1;
        }
        
            //first and prev buttons
        
        if($page>'1'){
            $pagination.='<li class="current"><a href="'.$webpage.'?page=1">Inicio</a></li>
            <li class="current"><a href="'.$webpage.'?page='.($page-1).'">Ant</a></li>';
        }
        
            //provide a link to the previous block of links
        
        
        $prev_start = $h-$max_links; 
        $prev_end = $h-1;
        if($prev_start <=1){
            $prev_start=1;
        }
        $prev_block = "$prev_start a $prev_end";
        
        if($page>$max_links){
            $pagination.='<li class="current"><a href="'.$webpage.'?page='.$prev.'">'.$prev_block.'</a></li>';
        }
        
            //loop through the results
            
        for ($i=$h;$i<$max_links_marker;$i++){
            if($i==$page){
                $pagination.= '<li><a class="current">'.$i.'</a></li>';
            }
            else{
                $pagination.= '<li><a href="'.$webpage.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
            //provide a link to the next block o links
        
        $next_start = $max_links_marker; 
        $next_end = $max_links_marker+$max_links;
        if($next_end >=$total_pages){
            $next_end=$total_pages;
        }
        $next_block = "$next_start a $next_end";
        if($total_pages>$max_links_marker-1){
            $pagination.='<li class="current"><a href="'.$webpage.'?page='.$max_links_marker.'">'.$next_block.'</a></li>';
        }
        
          //link to next and last pages
        
        
        if(($page >="1")&&($page!=$total_pages)){
            $pagination.='<li class="current"><a href="'.$webpage.'?page='.($page+1).'">Prox</a></li>
                  <li class="current"><a href="'.$webpage.'?page='.$total_pages.'">Final</a></li>';
        }
    }
    
    //if one page of results
    
    else{
      $pagination.='<li><a href="" class="current">1</a></li>';
    }
    $pagination.='</ul>
        </div>';
    
    return($pagination);
}

