

jQuery(document).ready(function( $ ) {

  if ($('.filter-btns').length > 0) {
    if ($(location).attr('hash')) {
      var section_category = window.location.hash.substr(1);

      $('.section').each(function(){
        $(this).addClass('hidden');
        if ($(this).hasClass('section--' + section_category)) {
          $(this).removeClass('hidden').addClass('shown');
        }
      });
      $('[href*="'+section_category+'"]').addClass('active');

    }

    $('.filter-btns a').click(function(){
      $('.filter-btns a').each(function(){
        $(this).removeClass('active');
      });
      $(this).addClass('active');
      var sc_href = $(this).attr('href');
      $('.section').each(function(){
        $(this).addClass('hidden');
        if ($(this).hasClass('section--' + sc_href.substring(1, sc_href.length))) {
          $(this).removeClass('hidden').addClass('shown');
        }
      });
    });
  }


});
