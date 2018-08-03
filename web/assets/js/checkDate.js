$(function() {
	     	  //varition de la l'option journée et demi journée
	     	  var date_jour = new Date();
              if (date_jour.getHours() > 13) {
	     	 $('.form .type_journee').html('<option value="Demi-journée">Demi-journée</option>');
	     	 }
            //Action exercution lorsqu'on clique sur le lien ajouter un billet
	        $("#add_billet").on("click", function(){
		      	if($("#nbBillets").val() >= 1 && $("#lw_louvrebundle_orders_visiteDate").val() != "" && $("#lw_louvrebundle_orders_typeOrder").val() != ""  ){
	                //Afficher le contenu du formulaire des billets
	                var ticketsContent = $("#lw_louvrebundle_orders_tickets").attr("data-prototype");
	                $("#billets").html("");
	                for (var i = 0; i<$("#nbBillets").val(); i++) 
	                {
	                    var container = ticketsContent.replace(/__name__label__/g, 'Billet n°' + (i+1)).replace(/__name__/g,        i)
	                    $("#billets").append(container);
	                    $("#billets").show();
	                }
	                $("#bloc_save").show();
                }

	        });
        });