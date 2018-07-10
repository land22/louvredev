$(function(){
	
   $(".date_vit").change(function(){

      if ($(this).val() !== "") {
	        $.ajax({
	          type: 'get',
	          url:"{{ path('lw_louvre_avaible_date') }}",
	          beforeSend:function(){
	          	   if ($('.alert').length == 1 ) {
		          	//$('.form').before('<div class="alert alert-danger" role="alert">Veuillez choisir une autre date car nous ne pouvons pas vendre plus de 1000 billets pour une journée !!!</div>');	
		          	}

		           if($('.alert').length < 1 ){
		          	$('.form').before('<div class="alert alert-success" role="alert">Cette date est disponible !!!</div>');
		          	}
		          	if ($('.alert').length == 1 ) {
		          	//$('.form').before('<div class="alert alert-danger" role="alert">Veuillez choisir une autre date car nous ne pouvons pas vendre plus de 1000 billets pour une journée !!!</div>');	
		          	}
	          },
	          success: function(){
	          	console.log("opérationnel");
	          }
	        });
      }
      else {

      }
      
   });
});