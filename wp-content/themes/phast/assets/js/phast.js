jQuery(function($) {
    $(document).ready(function () { 
       
      // Tout le code ira ici

      $('.btn-search').click( function() {       
        var post_id = $('#select-theme').val();      
        $.ajax({
            url: phast.ajaxurl,
			method : 'POST', 
			data: {
                'action': 'search_actuality',
                'post_id': post_id
            }, 
			headers : {}, 
			success : function( data ) { 	  
				$( '#content' ).html(data);
			},
			error : function( data ) { 
				console.log( 'Erreur…'+data );
			}
		});
        
    });
  
    });
  });