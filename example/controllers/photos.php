<?php

include('C:\xampp\htdocs\test\classes\api_functions.php');
include('C:\xampp\htdocs\test\classes\Authorization.php');

Class Controller_Photos Extends Controller_Base {
	
	// шаблон
	public $layouts = "first_layouts";
	
	// главный экшен
	// если в url нет явно указанного экшена, то по дефолту вызывается index
	
	function index() 
	{
		session_start();
		//echo $_SESSION['token']->user_id;
		//echo $_SESSION['token']->get_token_true();
		
		$tt = new API_FUNCTIONS();
		$this->template->vars('var',$tt->get_object("photos.getAll","owner_id=".$_SESSION['token']->user_id."&count=200"."&access_token=".$_SESSION['token']->token)->response);		
			
		$this->template->view('index');
	}
	
	function photos_alb ()
	{
		session_start();
		$tt = new API_FUNCTIONS();
		
		
		$this->template->vars('var',$tt->get_object("photos.get", "owner_id=".$_SESSION['token']->user_id."&album_id=".$_GET["album"]."&access_token=".$_SESSION['token']->token)->response);

			$this->template->view('alb_photos');
	}
	
	function add ()
	{
		session_start();
		$tt = new API_FUNCTIONS();
		$result = $tt->get_object("photos.getUploadServer","&album_id=".$_POST['one']."&access_token=".$_SESSION['token']->token)->response;
		
		move_uploaded_file($_FILES['photoadd']['tmp_name'], 'C:\xampp\img/'.$_FILES['photoadd']['name']);
		$file = array ('photo'=>curl_file_create('C:\xampp\img/'.$_FILES['photoadd']['name'],$_FILES['photoadd']['type'],$_FILES['photoadd']['name']));

		$res = $tt->get_object_byurl($result->upload_url, $file);
		
		unlink('C:\xampp\img/'.$_FILES['photoadd']['name']);
		
		$port=$tt->get_object("photos.save",'&album_id='.$result->aid.'&server='.$res->server.'&photos_list='.$res->photos_list.'&hash='.$res->hash.'&access_token='.$_SESSION['token']->token)->response[0];

		

		echo  '<div class = "col-md-4"><img src ="'.$port->src_big.'" class = "img-responsive"></div>';	
	}
	
		function walladd ()
	{
		session_start();
		$tt = new API_FUNCTIONS();
		$result = $tt->get_object("photos.getWallUploadServer","&access_token=".$_SESSION['token']->token)->response;
		
		move_uploaded_file($_FILES['photoadd']['tmp_name'], 'C:\xampp\img/'.$_FILES['photoadd']['name']);
		$file = array ('photo'=>curl_file_create('C:\xampp\img/'.$_FILES['photoadd']['name'],$_FILES['photoadd']['type'],$_FILES['photoadd']['name']));

		$res = $tt->get_object_byurl($result->upload_url, $file);
		
		//print_r($res);
		
		unlink('C:\xampp\img/'.$_FILES['photoadd']['name']);
		
		$port=$tt->get_object("photos.saveWallPhoto",'&user_id='.$_SESSION['token']->user_id.'&server='.$res->server.'&photo='.$res->photo.'&hash='.$res->hash.'&access_token='.$_SESSION['token']->token)->response[0];

		//print_r($port);

		echo  '<div class = "col-md-4"><img src ="'.$port->src_big.'" class = "img-responsive"></div>';	
		

	}
	
	
	
	
}


