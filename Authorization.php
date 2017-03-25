<?php
class Connection
{
  var $request_params;
  var $tok_name;
  
  function __construct ($app_id, $mask)
  {
    $this->request_params = 
    [
      'client_id' =>$app_id,
      'client_secret'=>'GBWYB5Rz7W1JWg6ju3sj',
      'grant_type'=>'client_credentials'
    ];
  }
  
  public function get_connection_to_token ()
  {
    return  file_get_contents ('https://oauth.vk.com/access_token?'.http_build_query($this->request_params));            //'https://oauth.vk.com/authorize?'.http_build_query($this->request_params);
  }
  
  function get_connection_method ($method_name, $instruction)
  {
    return  file_get_contents('https://api.vk.com/method/'.$method_name.'?'.'&fields='.$instructions.'&access_token='.$this->tok_name.'&v=5.62');
  }
}


$obj = new Connection (261061018, 'friends, photos'); 
$perspect = 'https://oauth.vk.com/authorize?client_id=261061018&scope=notify,photos,friends,audio,video,notes,pages,docs,status,questions,offers,wall,groups,messages,notifications,stats,ads,offline&redirect_uri=http://oauth.vk.com/blank.html&display=page&response_type=token';
$curl = curl_init($perspect);
curl_setopt($curl, CURLOPT_URL, $perspect);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($curl, CURLOPT_POST, 1); 
$out = curl_exec($curl);
curl_close($curl);
echo $out;
echo 'fdsdf';
?>
