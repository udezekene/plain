(function($) {
  $('.plain_loadmore').click(function(){
 
    var button = $(this),
        data = {
      'action': 'loadmore',
      'query': plain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
      'page' : plain_loadmore_params.current_page
    };
 
    $.ajax({
      url : plain_loadmore_params.ajaxurl, // AJAX handler
      data : data,
      type : 'POST',
      beforeSend : function ( xhr ) {
        button.text('Loading...'); // change the button text, you can also add a preloader image
      },
      success : function( data ){
        if( data ) { 
          button.text( 'More posts' ).prev().before(data); // insert new posts
          plain_loadmore_params.current_page++;
 
          if ( plain_loadmore_params.current_page == plain_loadmore_params.max_page ) 
            button.remove(); // if last page, remove the button
        } else {
          button.remove(); // if no data, remove the button as well
        }
      }
    });
  });
})(jQuery);