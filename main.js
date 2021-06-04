
$(document).ready(function(){

$("#form").submit(function(e){
	e.preventDefault();

	var inputs = $(this).serialize();

	$.post("views/add.php",inputs,function(data){

				$('.content').load('views/refresh.php');
				
			    


	})

})


});