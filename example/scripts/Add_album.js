function addAlbum (e)
{
	        $.ajax({
     
            url: 'https://localhost/test/albums/control',
            type: 'POST',
            data: "&function=photos.createAlbum&params="+document.getElementsByName('albumName')[0].value, 
            
            }).done(function(data){


			$("#Alb").append(data);
			
			

			});	
}


function addAlbum (arg)
{
	        $.ajax({
     
            url: 'https://localhost/test/albums/delete',
            type: 'POST',
            data: "&id="+arg, 
            
            }).done(function(){


			$("#").(data);
			
			

			});	
}





$(function(){

	$('#my_form').on('submit', function(e){
		
		e.preventDefault();
		var $that = $(this),
				formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму
				formData.append('date_upl', new Date()); // добавляем данные, не относящиеся к форме
		$.ajax({
			url: $that.attr('action'),
			type: $that.attr('method'),
			contentType: false, // важно - убираем форматирование данных по умолчанию
			processData: false, // важно - убираем преобразование строк по умолчанию
			data: formData,
			}).done(function(data){

		
				$("#Alb").append(data);
		
			});	
		});
	});





 /*function addPhotos()
{
		
		 e.preventDefault();
    var $that = $(this),
    formData = new FormData($that.get(0));
	alert(arg);
		    $.ajax({
     
            url: 'https://localhost/test/photos/add',
            type: 'POST',
			contentType: false, // важно - убираем форматирование данных по умолчанию
			processData: false,
            data: "&al="+arg+"&ph="+document.getElementsByName('photoadd')[0].files[0], 
            
			
            }).done(function(data){


			$("#Pht").append(data);
			
			alert(data);

			});	
	
	
	
}*/


	
 