<?php

//print_r($var);
echo '<div class="panel-body"  style = "background-color: #FFF"> <div id = "Alb">'; 
for ($i=0;$i<Count($var);$i++)
{
echo '<div class="panel panel-default col-md-4" style = "color: black" > <div class="panel-body">';
  
  echo '<a href="https://localhost/test/photos/photos_alb?album='.$var[$i]->aid.'"><h4 align = "left">Название : '.$var[$i]->title.'</h4></a>';
  echo '<h4 align = "left">Размер : '.$var[$i]->size.'</h4>';
  echo    '<button type="button" class="btn btn-default" data-dismiss="modal" onClick="DelAlb('.$var[$i]->aid.')">Удалить</button>';
  
 echo '</div> </div>';	
	

}
echo '</div>';

//echo '<script src="file://C:\xampp\htdocs\test\scripts\Add_album.js"> </script>';
echo

'<a href="#myModal" class="btn btn-primary" data-toggle="modal">Открыть модальное окно</a>  


<!-- HTML-код модального окна -->
<div id="myModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" style = "color: black">Создание альбома</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body" style = "color: black" >
		
		<p>Название  <input type="text" name="albumName"></input> </p>
     
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" onClick = "addAlbum()">Создать альбом</button>
      </div>
    </div>
  </div>
</div>';

echo '</div>';