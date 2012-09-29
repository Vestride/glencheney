/**
 * Smooth Scrolling plugin
 * @author  Glen Cheney
 * @date 9.28.12
 */
(function($, window) {

    var defaults = {
        target: 'body',
        speed: 600,
        easing: $.easing.easeOutQuad ? 'easeOutQuad' : 'swing',
        showHash: true,
        callback: $.noop
    },

    _animate = function(offset, speed, easing, complete) {
        // Scroll!
        $('html, body').animate({
            scrollTop: offset
        }, speed, easing, complete);
    },

    _showHash = function(hash, $target) {
        var $fake;

        hash = hash.replace(/^#/, '');

        if ( $target.length ) {
            $target.attr( 'id', '' );
            $fake = $( '<div/>' ).css({
                position: 'absolute',
                visibility: 'hidden',
                top: $(window).scrollTop() + 'px'
            })
            .attr( 'id', hash )
            .appendTo( document.body );
        }

        window.location.hash = hash;
        
        if ( $target.length ) {
            $fake.remove();
            $target.attr( 'id', hash );
        }

    },

    scroll = function(options, fn) {
        var opts = $.extend({}, defaults, options),
            $target = $(opts.target),
            offset = $target.offset().top,
            totalHeight = document.body.clientHeight,
            screenHeight = $(window).height();

        if (typeof fn === 'function') {
            opts.callback = fn;
        }

        // Make sure we have room to scroll
        if (totalHeight - offset < screenHeight) {
            offset -= screenHeight - (totalHeight - offset);
        }

        if (opts.showHash) {
            _showHash(opts.target, $target);
        }

        _animate(offset, opts.speed, opts.easing, opts.callback);
        
    };
    
    $.simplescroll = scroll;

    // If we load the page with a hash, scroll to it
    $.simplescroll.initial = function(options, fn) {
        if (window.location.hash) {
            options = $.extend(options, {target: window.location.hash});
            $.simplescroll(options, fn);
        }
    };
})(jQuery, window);