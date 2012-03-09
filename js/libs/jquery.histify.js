/**
 * Inspired by History.js and jQuery.pjax.js
 * 
 */
(function($) {
    var $container = $('#container'),
        $main = $('#main'),
        baseUrl = document.location.protocol + '//' + (document.location.hostname || document.location.host),
        
        
        // Used to detect initial (useless) popstate.
        popped = ('state' in window.history),
        initialURL = location.href;

    

    function loadPage(url) {
        $container.addClass('loading');
        $.ajax({
            url : url,
            dataType : 'html',
            data : 'ajax=1',
            success : function(response) {
                pageLoaded($(response), url);
            }
        });
    }

    function pageLoaded($response, url) {
        var $title = $response.filter('#page-title'),
            title = $title.text(),
            $content = $response,
            relativeUrl = url.replace(baseUrl, ''),
            state,
            hasHash = relativeUrl.match(/#/),
            scrollingTo,
            urlNoHash;
            
        // If the url hash a hash in it, scroll to that instead of the top
        scrollingTo = hasHash ? relativeUrl.substr(hasHash.index) : $main;
        
        urlNoHash = hasHash ? relativeUrl.substring(0, hasHash.index) : relativeUrl;
        
        state = {
            histify : true,
            title : title,
            path : urlNoHash
        }
            
        // Remove the title span - we don't need it
        $title.remove();
        
        // TODO remove when browsers actually support the title
        // argument in the pushState function
        $('head title').text(title);

        // Add an entry to the browser history
        if (window.history.state) {
            history.pushState(state, title, url);
        } else {
            history.pushState(null, title, url);
        }
        
        // Save our state to the plugin
        $.histify.state = state;

        // Ajaxify new content
        $content.histify();
        
        // Replace current content
        $main.html($content);

        // Fix header urls
        Vestride.fixHeaderLinks(url);

        // Inform Google Analytics of the change
        if ( typeof pageTracker !== 'undefined' ) {
            pageTracker._trackPageview(relativeUrl);
        }
        
        
        
        // Scroll to new content (after a brief delay)
        // Images are still probably loading and we might not scroll
        // to exactly where we want :\
        setTimeout(function() {
            $container.removeClass('loading');
            $.scrollTo(scrollingTo, {duration: 600});
        }, 500);
    }
    
    $.fn.histify = function() {
        this.find('a[data-pjax]').click(function(event) {
            var url = $(this).attr('href');
            // Middle click, cmd click, and ctrl click should open
            // links in a new tab as normal.
            if (event.which > 1 || event.metaKey) {
                return true;
            }
            
            event.preventDefault();
            loadPage(url);
        });
        
        
        return this;
    };
    
    $.histify = $.fn.histify;
    
    $(window).bind('popstate', function(event) {
        // Ignore inital popstate that some browsers fire on page load
        var initialPop = !popped && location.href == initialURL;
        popped = true;
        if (initialPop) return;
        
        // If the history entry being activated was created by a call to history.pushState() or was affected by a call to history.replaceState()
        var curRelUrl = location.pathname.replace(baseUrl, '');
        
        // If the urls have the same file in them, ignore it (most likely a jump link)
        if ($.histify.state && curRelUrl.match($.histify.state.path)) {
            return;
        }
        
        if ((event.state && event.state.histify) || ($.histify.state && $.histify.state.path !== curRelUrl)) {
            loadPage(location.href);
        }
    });
})(jQuery);