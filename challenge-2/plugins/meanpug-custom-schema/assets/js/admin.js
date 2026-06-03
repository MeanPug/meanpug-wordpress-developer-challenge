( function ( $ ) {
    'use strict';

    $( document ).ready( function () {
        // Restrict year fields to 4 digits.
        $( 'input[name="attorney_bar_year"], input[name="attorney_graduation_year"], input[name="case_result_year"]' ).on( 'input', function () {
            var val = $( this ).val().toString();
            if ( val.length > 4 ) {
                $( this ).val( val.slice( 0, 4 ) );
            }
        } );
    } );
} )( jQuery );