<?php


get_object();


function get_object ()
{
include('C:\xampp\htdocs\test\classes\api_functions.php');	
	
	
	session_start();
	$func = new API_FUNCTION ();	
	$result = $func->get_object ($_POST["function"], "&title=".$_POST['params']."&access_token=".$_SESSION['code']->get_token_true());


echo '<div class="panel panel-default col-md-4" style = "color: black"> <div class="panel-body">';
  
  echo '<h4 align = "left">Название : '.$result->title.'</h4>';
  echo '<h4 align = "left">Размер : '.$result->size.'</h4>';
  
 echo '</div> </div>';	

}






?>