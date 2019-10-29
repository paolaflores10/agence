$( document ).on( 'focus', ':input', function(){
    $( this ).attr( 'autocomplete', 'off' );
});