/*! common.js | Bulkit | CSS Ninja */

/* ==========================================================================
js pageloader file 
========================================================================== */

$(document).ready(function($){
    
    "use strict";

    //Page loader
    if ($('.pageloader').length) {

        $('.pageloader').toggleClass('is-active');

        $(window).on('load', function() {
        var pageloaderTimeout = setTimeout( function() {
            $('.pageloader').toggleClass('is-active');
            $('.infraloader').toggleClass('is-active')
            clearTimeout( pageloaderTimeout );
        }, 700 );
        })
    }
});