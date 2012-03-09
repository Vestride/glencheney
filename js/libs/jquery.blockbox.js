;(function($) {
    var blockbox = 'blockbox',
    $body = $('body'),
    $mask = $('<div></div>', {"class" : "blockbox-mask closed"}),
    $container = $('<div></div>', {"class" : "blockbox-container closed"}),
    $content = $('<div></div>', {"class" : "blockbox-content"}),
    isOpen = false,
    spinnerOpts = { 
        lines: 12, // The number of lines to draw
        length: 7, // The length of each line
        width: 5, // The line thickness
        radius: 10, // The radius of the inner circle
        color: '#F0F0F0', // #rbg or #rrggbb
        speed: 1, // Rounds per second
        trail: 100, // Afterglow percentage
        shadow: true // Whether to render a shadow
    },
    spinnerCss = {
        position: 'fixed',
        zIndex: '7',
        top: '50%',
        left: '50%',
        marginLeft: '-16px',
        marginTop: '-16px'
    },
    $spinner = $('<div class="blockbox-spinner"></div>', spinnerCss).css(spinnerCss),

    methods = {
        init : function(options) {

            return this.each(function() {

                var $this = $(this),
                    container = this,
                    settings = {
                        navFilter : '',
                        animate : {
                            left: 3000,
                            opacity: 0.5
                        }
                    },
                    data = $this.data(blockbox);
                    
                if (options) {
                    $.extend(settings, options);
                }
                
                settings.animateprev = {
                    left : settings.animate.left + 'px',
                    opacity: settings.animate.opacity
                };
                settings.animatenext = {
                    left : '-' + settings.animate.left + 'px',
                    opacity: settings.animate.opacity
                }


                if (!data) {
                    var $links = $this.find('a');

                    data = {
                        settings: settings,
                        $links : $links,
                        navLinks : null,
                        currentIndex : null
                    };
                    
                    // Save our settings for the updateNavLinks function
                    $this.data(blockbox, data);
                    data.navLinks = methods.updateNavLinks.call(this);
                    
                    // Save our new links
                    $this.data(blockbox, data);

                }

                // On a clicked link
                data.$links.click(function(event) {
                    // Ignore it if it's a middle click or ctrl click
                    if (event.which > 1 || event.metaKey) {
                        return true;
                    }
                    event.preventDefault();

                    // Show loading
                    $body.append($spinner);

                    // Update the links that we can navigate through in the preview
                    data.navLinks = methods.updateNavLinks.call(container);

                    // Find which link we're dealing with
                    data.currentIndex = $.inArray(this.href, data.navLinks);

                    // Save data back
                    $this.data(blockbox, data);

                    // Get content
                    methods.loadContent.call(container, this.href);
                });
            });

        },
        
        loadContent : function(url, type) {
            var container = this;
            $spinner.spin();
            $.ajax({
                url : url,
                dataType : 'html',
                data : 'ajax=1',
                success : function(response) {
                    methods.contentLoaded.call(container, response, type);
                }
            });
        },

        /**
         * Called when the content has been returne from the server.
         * Animates neccessary elements and adds events to the new content.
         *
         * @param {HTMLElement} response the html returned from ajax request
         * @param {String|null} type last navigation button clicked
         */
        contentLoaded : function(response, type) {
            var container = this,
                info = $(this).data(blockbox),
                settings = info.settings,
                oppType = type === 'next' ? 'prev' : 'next';
            
            // Trigger the on content removed event for those interested
            $(window).trigger('contentremove.Blockbox');

            if (isOpen) {
                $(response).addClass(type);
            }

            // Insert content
            // if dialog hasn't already been opened, just append it
            if (!type) {
                $content.html(response);
            }
            
            // Content has already been here, place it off screen so we can animate it in
            else {
                $content.css('left', settings['animate' + oppType].left).html(response);
            }

            
            if (!isOpen) {
                // Add close handler to mask (not modal)
                $mask.click(function(e) {
                    e.preventDefault();
                    methods.remove();
                });
                
                // With display: box, the container takes up the entire screen and the mask
                // is underneath, so we add an event to it and test if we've only clicked on the container
                $container.click(function(e) {
                    if (e.target.className === 'blockbox-container') {
                        methods.remove();
                    }
                });

                // Add mask and content to page
                $container.append($content);
                $body.append($mask, $container);

                // And we're open!
                isOpen = true;
            }
            
            
            // Set up nav and nav events
            methods.getNav.call(container, info.currentIndex, info.navLinks.length);
            
            // Remove loading
            $spinner.spin(false);
            
            // Launched for the first time
            if (!type) {
                // Show content
                methods.showBox();
            }
            
            // Preview already open
            else {
                $content.animate({left : '0px', opacity: '1'}, {duration:600, queue:true});
            }

            
            $(window).trigger('contentloaded.Blockbox');
        },
        
        /**
         * Hides or shows the navigation. Adds click events for navigation and close buttons
         * 
         * @param {int} i current index in the navigation
         * @param {int} len length of the navigation links array
         */
        getNav : function(i, len) {
            var container = this,
                $prev = $content.find('.nav-prev'),
                $next = $content.find('.nav-next');
            if (i === 0) {
                $prev.removeClass('can-nav');
            } else {
                $prev.addClass('can-nav');
                $prev.click(function() {
                    methods.prev.call(container);
                });
            }

            if (i === len - 1) {
                $next.removeClass('can-nav');
            } else {
                $next.addClass('can-nav');
                    $next.click(function() {
                    methods.next.call(container);
                });
            }
            
            // Add close event handler to ajax content div
            $content.find('.blockbox-close').click(function(){
                methods.remove();
            });
            
            // Show the status
            methods.updateStatus($('.filter-options .active').text(), i + 1, len);
        },

        next : function() {
            var container = this,
                info = $(this).data(blockbox),
                url;

            if (info.currentIndex + 1 === info.navLinks.length) {
                console.warn('Cannot go forward, index out of range');
                return;
            } else {
                info.currentIndex++;
            }

            url = info.navLinks[info.currentIndex];

            // Save the data back
            $(this).data(blockbox, info);

            methods.loadContent.call(container, url, 'next');
            $content.animate(info.settings.animatenext, {duration:600, queue:true});

        },

        prev : function() {
            var container = this,
                info = $(this).data(blockbox),
                url;

            if (info.currentIndex - 1 < 0) {
                console.warn('Cannot go back, index out of range');
                return;
            } else {
                info.currentIndex--;
            }

            url = info.navLinks[info.currentIndex];

            // Save the data back
            $(this).data(blockbox, info);
            
            methods.loadContent.call(container, url, 'prev');
            $content.animate(info.settings.animateprev, {duration:600, queue:true});
        },

        hideBox : function() {
            var msUntilClose = 800;
            $container.addClass('closed');
            setTimeout(function() {
                $mask.addClass('closed');
                $(window).trigger('closed.Blockbox');
            }, msUntilClose);
        }, 

        showBox : function() {
            var msUntilOpen = 800;
            $mask.removeClass('closed');
            setTimeout(function() {
                $container.removeClass('closed');
                $(window).trigger('open.Blockbox');
            }, msUntilOpen);
        },

        remove : function() {
            var msUntilRemove = 1500;
            methods.hideBox();
            setTimeout(function() {
                var collection = $mask.add($container);
                collection.remove();
                isOpen = false;
                $(window).trigger('removed.Blockbox');
            }, msUntilRemove);
        },

        updateNavLinks : function() {
            var info = $(this).data(blockbox),
                navLinks = info.settings.navFilter ? $(info.settings.navFilter).get() : info.$links.get(),
                len = navLinks.length,
                i = 0;

            for (; i < len; i++) {
                navLinks[i] = navLinks[i].href;
            }

            return navLinks;
        },
        
        /**
         * Modifies the text at the top right to display the index of the current
         * item and category it has been filtered from
         * 
         * @param {string} category
         * @param {int} position current index
         * @param {int} total total navigation items
         */
        updateStatus : function(category, position, total) {
            $('.blockbox-status').text(category + ' ' + position + '/' + total);
        }
    };
    
    $.fn.blockbox = function(method) {
        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || ! method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' +  method + ' does not exist on jQuery.blockbox');
        }    
  
    };
})(jQuery);