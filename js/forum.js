$(document).ready(function(){ 

$('[data-confirm]').on('click',function(e){

	e.preventDefault();

	var href = $(this).attr('href');
	var message = $(this).data('confirm');

swal({

title: "Êtes vous sûr?",
text: message,
type: "warning",
showCancelButton: true,
cancelButtonText: "Annuler",
confirmButtonText: "Oui",
confirmButtonColor: "#DD6B55"

}, function(isConfirm){

if(isConfirm){

	window.location.href = href;
		
		}
		
		 }) ;

		});
		
		var url = 'search_forum.php';

			$('#recherche_forum').on('keyup',function(){
				var query= $(this).val();
				
				if (query.length>0) {

				$.ajax({

						type: 'POST',
						url: url,
						data: {

							query : query

						},

						success: function(data){

							$("#display-results").html(data).show();
						}
				});

				 }

			});

	});