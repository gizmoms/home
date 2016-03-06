(function( $ ){
    $.fn.slideAddNewForm = function() {
        if($('#'+$(this).attr('id')+ '> i').length > 0) {
            $('#'+$(this).attr('id')+' i').toggleClass('blue');
        }
        if($(this).data('icon')) {
            $('#'+$(this).data('icon')+' i').toggleClass('blue');
        }
        $('#'+$(this).data("target")).css('visibility', 'visible');
        $('#'+$(this).data("target")).slideToggle(800);
    };
})( jQuery );