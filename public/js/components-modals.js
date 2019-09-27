/*! components-modals.js | Bulkit | CSS Ninja */

/* ==========================================================================
Bulma modals implementation
========================================================================== */

$(document).ready(function($){
    
    "use strict";

    //main variable
    var modalID;
    
    //Triggering a modal
    $('.modal-trigger').on("click", function(){
        $(".navbar-wrapper").css('display', 'none');
        modalID = $(this).attr('data-modal');
        $('#' + modalID).toggleClass('is-active');
        $('#' + modalID + ' .modal-background').toggleClass('scaleInCircle');
        $('#' + modalID + ' .modal-content').toggleClass('scaleIn');
        $('#' + modalID + ' .modal-close').toggleClass('is-hidden');
        $("#parent").toggleClass('is-clipped');
        //Prevent sticky fixed nav and backtotop from overlapping modal
        $('#scrollnav, #backtotop').toggleClass('is-hidden');
        //Prevent body from scrolling when scrolling inside modal
        setTimeout(function(){
            if ($('.dashboard-wrapper').length) {
                $('body').addClass('is-fixed');
            }
        }, 700);
    });

    //Closing a modal
    $('.modal-close, .modal-dismiss').on("click", function(){
        $(".navbar-wrapper").css('display', 'block');
        $('#' + modalID + ' .modal-background').toggleClass('scaleInCircle');
        $('#' + modalID + ' .modal-content').toggleClass('scaleIn');
        $('#' + modalID + ' .modal-close').toggleClass('is-hidden');
        $("#parent").toggleClass('is-clipped');

        //Restore native body scroll
        if ($('.dashboard-wrapper').length) {
            $('body').removeClass('is-fixed');
        }
        setTimeout(function(){
            $('.modal.is-active').removeClass('is-active');
            //Restore sticky nav and backktotop
            $('#scrollnav, #backtotop').toggleClass('is-hidden');

        }, 500);
    })

    //Modal user select toggle
    $('.modal-card-body .card-select i').on("click", function(){
        $(this).toggleClass('is-active');
        $(this).closest('.flex-card').toggleClass('is-active');
        $('.save-btn').removeClass('is-disabled');
    })

    //Modal image gallery with slick carousel
    $('.modal-trigger.gallery-trigger').on("click", function(){
        //Prevents carousel from initiating on a non loaded image
        setTimeout(function(){
            $('.slick-gallery').slick({
                slidesToShow: 1,
                arrows: false,
                dots: true,
                cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
                autoplay: true,
                infinite: false
            });
        }, 100);
    })

    //Success message modal
    if ($('#success-icon').length) {
        var resetSuccess = $('#success-icon svg');//declare element to reset it at modal close
        //trigger svg animation  
        $('.success-trigger').on("click", function(){
            new Vivus('success-icon', {
                type: 'oneByOne',
                duration: 60, 
                animTimingFunction: Vivus.EASE_OUT_BOUNCE,
                selfDestroy: true,
                file: 'assets/images/illustrations/icons/modals/success.svg'
            });
        })
        //Reset element with initial clone
        $('.modal-close, .modal-dismiss').on("click", function(){
            $('#success-icon svg').replaceWith( resetSuccess );
        })
    }
    //Error message modal
    if ($('#error-icon').length) {
        var resetError = $('#error-icon svg');//declare element to reset it at modal close
        //trigger svg animation  
        $('.error-trigger').on("click", function(){
            new Vivus('error-icon', {
                type: 'oneByOne',
                duration: 60, 
                animTimingFunction: Vivus.EASE_OUT_BOUNCE,
                selfDestroy: true,
                file: 'assets/images/illustrations/icons/modals/error.svg'
            });
        })
        //Reset element with initial clone
        $('.modal-close, .modal-dismiss').on("click", function(){
            $('#error-icon svg').replaceWith( resetError );
        })
    }
    //Warning message modal
    if ($('#warning-icon').length) {
        var resetWarning = $('#warning-icon svg');//declare element to reset it at modal close
        //trigger svg animation 
        $('.warning-trigger').on("click", function(){
            new Vivus('warning-icon', {
                type: 'oneByOne',
                duration: 60, 
                animTimingFunction: Vivus.EASE_OUT_BOUNCE,
                selfDestroy: true,
                file: 'assets/images/illustrations/icons/modals/warning.svg'
            });
        })
        //Reset element with initial clone
        $('.modal-close, .modal-dismiss').on("click", function(){
            $('#warning-icon svg').replaceWith( resetWarning );
        })
    }
    //Info message modal
    if ($('#info-icon').length) {
        var resetInfo = $('#info-icon svg');//declare element to reset it at modal close
        //trigger svg animation  
        $('.info-trigger').on("click", function(){
            new Vivus('info-icon', {
                type: 'oneByOne',
                duration: 60, 
                animTimingFunction: Vivus.EASE_OUT_BOUNCE,
                selfDestroy: true,
                file: 'assets/images/illustrations/icons/modals/info.svg'
            });
        })
        //Reset element with initial clone
        $('.modal-close, .modal-dismiss').on("click", function(){
            $('#info-icon svg').replaceWith( resetInfo );
        })
    }

})

