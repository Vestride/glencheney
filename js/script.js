/* Author: Glen Cheney
*/

function ucFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

/**
 * Object for creating dialogs.
 */
var Dialog = {
    
    /**
     * Creates a basic dialog box with a dark mask overlay and a close button
     * 
     * @param {object} options
     * <pre>
     *  - content:      {string|HTMLElement} all the content that will go in the dialog. Can be a string or html element
     *  - width:        {int}       [optional] width of the dialog. Default = 600
     *  - stylePrefix  {string}    [optional] Add id's to the container and content element with a prefix for css styling
     *  - top:          {int}       [optional] Distance (px) from the top of the screen. Default = auto
     *  - onopen        {function}  [optional] this function will be executed right before the mask and dialog are appended to the document. Default = empty
     *  - onclose:      {function}  [optional] this function will be fired when the close button is clicked, but before the dialog is closed. default = nothing
     *  - maskBackground:{string}   [optional] background for the mask. Default = dark transparent gray. Use 'none' for no background.
     *  - modal:        {boolean}   [optional] Close the dialog when the user clicks on the close button. Default = true 
     * </pre>
     */
    create : function(options) {
        // Settings
        var defaults = {
            content : '',
            title : '',
            width: 450,
            topPx : 'auto',
            onopen : function() {},
            onclose : function() {},
            maskBackground : null,
            stylePrefix : null,
            modal : false,
            classes : []
        };
        
        $.extend(defaults, options);
        
        var settings = {
            leftMargin : (defaults.width / 2) * -1,
            maskClass : 'es-dialog-mask',
            containerClass : 'es-dialog-container',
            insideClass : 'es-dialog-inside',
            closeClass : 'es-dialog-close',
            closeFunction : function(e) {
                defaults.onclose();
                e.preventDefault();
                Dialog.close();
            },
            openFunction : function() {
                defaults.onopen();
                if (Dialog.isOpen) {
                    Dialog.close();
                }
            },
            $body : $('body'),
            $mask : null,
            $container : null,
            $header : null,
            $dialogInside : null,
            $h3 : null,
            $x : null
        };

        // Mask
        settings.$mask = $('<div></div>', {"class" : settings.maskClass}).css({
            'background' : settings.maskBackground
        });
        
        // Close the dialog when mask is clicked on if not modal
        if (!defaults.modal) {
            settings.$mask.click(function(e) {
                settings.closeFunction(e);
            });
        }

        // Container
        settings.$container = $('<div></div>', {"class" : settings.containerClass}).css({
            'margin-left' : settings.leftMargin + 'px',
            'width' : defaults.width + 'px'
        });
        
        if (defaults.classes.length > 0) {
            settings.$container.addClass(defaults.classes.join(' '));
        }
        
        if (defaults.stylePrefix) {
            settings.$container.addClass(defaults.stylePrefix + '-' + defaults.containerClass);
        }
        
        if (defaults.topPx !== 'auto') {
            settings.$container.css({
                'margin-top' : '0px',
                'top' : defaults.topPx + 'px'
            });
        }
        
        // Dialog Header
        settings.$header = $('<div></div>', {"class" : 'es-dialog-header'});
        settings.$h3 = $('<h3></h3>').text(defaults.title);
        settings.$header.append(settings.$h3);
        

        // Close Link
        settings.$x = $('<a></a>', {
            'href' : '#',
            'title' : 'Close',
            'class' : settings.closeClass
        }).text('×').click(function(e) {
            settings.closeFunction(e);
        });
        
        settings.$header.append(settings.$x);

        // Put the content into the dialog
        settings.$dialogInside = $('<div></div>', {"class" : settings.insideClass}).html(defaults.content);
        
        if (defaults.stylePrefix) {
            settings.$dialogInside.addClass(defaults.stylePrefix + '-' + settings.insideClass);
        }
        
        settings.$container.append(settings.$header, settings.$dialogInside);
        
        // Save mask and container for later access
        this._container = settings.$container;
        this._mask = settings.$mask;
        
        // Call our onopen function hook
        settings.openFunction();

        // Show the dialog
        settings.$body.append(settings.$mask, settings.$container);
        
        this.isOpen = true;
        if (defaults.topPx == 'auto') {
            this.centerVertically();
        }
    },
    
    /**
     * Removes the dialog from the page
     */
    close : function() {
        this.getMask().add(this.getContainer()).remove();
        this.isOpen = false;
        this._mask = null;
        this._container = null;
        
        // Call any built up functions
        var i;
        for(i = 0; i < this.callbacks.length; i++) {
            this.callbacks[i]();
        }
    },
    
    /**
     * Adds a function to the callbacks array
     */
    addCallback : function(fn) {
    	if (typeof fn === "function") {
            this.callbacks.push = fn;
    	}
    },
    
    centerVertically : function() {
        var container = this.getContainer().get(0);
        container.style.height = "";
        container.style.height = container.offsetHeight + 'px';
        container.style.marginTop = (parseInt(container.style.height) / 2) * -1 + 'px';
    },
    
    callbacks : [],
    
    isOpen : false,
    
    _mask : null,
    getMask : function() {
        return this._mask;
    },
    
    _container : null,
    getContainer : function() {
        return this._container;
    }
};

var Vestride = {

    /**
     * Base url for the site, e.g. http://eightfoldstudios.com
     */
    baseUrl : document.location.protocol + '//' + (document.location.hostname || document.location.host),
    
    onHomePage : true,
    
    themeUrl : null,
    
    spinnerOpts : {
        lines: 12, // The number of lines to draw
        length: 7, // The length of each line
        width: 5, // The line thickness
        radius: 10, // The radius of the inner circle
        color: '#F0F0F0', // #rbg or #rrggbb
        speed: 1, // Rounds per second
        trail: 100, // Afterglow percentage
        shadow: true // Whether to render a shadow
    },
    
    backdrop : {
        fullHeight : null,
        minHeight : null,
        availableToScroll : null,
        friction : 0.3,
        $backdrop : null,
        $city : null,
        $cityCompact : null,
        $sunburst : null,
        $navLogo : null,
        centered : 0,
        left : -180
    },
    
    initBackdrop : function() {
        this.backdrop.$backdrop = $('.backdrop');
        this.backdrop.$city = this.backdrop.$backdrop.find('.city');
        this.backdrop.$cityCompact = this.backdrop.$backdrop.find('.city-compact');
        this.backdrop.$sunburst = this.backdrop.$backdrop.find('.sunburst');
        this.backdrop.$navLogo = $('nav .logo');
        this.backdrop.fullHeight = this.backdrop.$backdrop.height();
        this.backdrop.minHeight = this.backdrop.$city.height() + 10;
        this.backdrop.availableToScroll = this.backdrop.fullHeight - this.backdrop.minHeight;
    },
    
    modifyBackdrop : function() {
        var scrolled = $(window).scrollTop(),
            newHeight = this.backdrop.fullHeight - (scrolled * this.backdrop.friction),
            amountScrolledWithFriction,
            leftToScroll,
            percentScrolled,
            backdropX,
            compactOpacity;
            
        
        if (newHeight < this.backdrop.minHeight) {
            newHeight = this.backdrop.minHeight;
            this.backdrop.$backdrop.addClass('minimized');
            this.backdrop.$navLogo.addClass('visible');
        } else {
            this.backdrop.$backdrop.removeClass('minimized');
            this.backdrop.$navLogo.removeClass('visible');
        }
        
        leftToScroll = newHeight - this.backdrop.minHeight;
        amountScrolledWithFriction = this.backdrop.availableToScroll - leftToScroll;
        percentScrolled = compactOpacity = amountScrolledWithFriction / this.backdrop.availableToScroll;
        
        // Constrain the opacity of the compact city to .3 opacity;
        if (compactOpacity > 0.7) compactOpacity = 0.7;
        this.backdrop.$cityCompact.css('opacity', 1 - compactOpacity);
        this.backdrop.$city.css('opacity', percentScrolled);
        
        backdropX = this.backdrop.centered + Math.round(percentScrolled * this.backdrop.left);
        
        if (backdropX < this.backdrop.left) newHeight = this.backdrop.left;
        
        // Move the text at the same speed as regular scrolling
        this.backdrop.$backdrop.children().first().css('bottom', scrolled);
        
        // Move the city over
        this.backdrop.$sunburst.css('background-position', backdropX + 'px 0');
        
        // Move Backdrop at half speed
        this.backdrop.$backdrop.css('height', newHeight);
    },
    
    titles : {
        'home' : 'Home',
        'about' : 'About Us',
        'work' : 'Work',
        'contact' : 'Contact'
    },

    scrolledIt : function() {
        var title = 'Glen Cheney';
        // Highlight which section we're in
        $('#sections > section').each(function() {
            var $this = $(this)
              , id = $this.attr('id')
              , navId = '#a-' + id
              , label = title + ' | ' + Vestride.titles[id];
              
            if ($.inviewport($this, {threshold : 0})) {
                $(navId).addClass('in');
                $('title').text(label);
            } else {
                $(navId).removeClass('in');
            }
        });
        
        this.modifyBackdrop();
        
    },

    initCycle : function(anchorBuilder, selector) {
        if (!selector) {
            selector = '.carousel';
        }
        var $cycle = $(selector).cycle({
            timeout:  6000,
            speed:  400,
            pause: 1,
            pager: selector + '-control',
            next: '.carousel-next',
            prev: '.carousel-prev',
            pagerAnchorBuilder : function(index, el) {
                Vestride[anchorBuilder](this, index, el);
            },
            updateActivePagerLink : function(pager, index, active) {
                var title = $('.carousel a').eq(index).attr('data-title');
                $(pager).children().removeClass(active).eq(index).addClass(active);
                
                $('.carousel-item-title').fadeOut('fast', function() {
                    $(this).text(title).fadeIn();
                });
            }
        });

        // Change carousel item on hover
        $(selector + '-control > *').mouseover(function(){
            var zeroBasedIndex = parseInt($(this).text()) - 1;
            $cycle.cycle(zeroBasedIndex);
        });
    },

    cycleWithLinks : function(self, index, el) {
        $(self.pager).append('<a href="' + $(el).find('a').attr('href') + '">' + (index + 1) + '</a>');
    },

    cycleNoLinks : function(self, index, el) {
        $(self.pager).append('<span>' + (index + 1) + '</span>');
    },

    initWorkFiltering : function() {
        $('.filter-options li').not('.paginate-nav').click(function() {
            var $this = $(this),
                $grid = $('#grid');

            // Hide current label, show current label in title
            $('.filter-options .active').removeClass('active');
            $this.addClass('active');
            $('.filter-title').text($this.text());

            // Filter elements
            $grid.paginate('paginate', $this.attr('data-key'));
        });
        
        $('#grid').paginate({
            itemWidth : 230,
            margins : 20,
            key : 'all'
        });
    },

    initLocalScroll : function() {
        $('#nav, .quick-links').localScroll({
            hash:true,
            duration:300
        });
    },

    initContactSubmit : function() {
        
        // Add blur and focus events so we can change the class of the arrows
        // to show if it's valid or invalid
        $('#contact input[type!="submit"], #contact textarea').focus(function() {
            $(this).parent().find('.arrow-down').addClass('active');
        }).blur(function(){
            var $parent = $(this).parent(),
                status;
                
            $parent.find('.arrow-down').removeClass('active');
            if (this.validity) {
                status = this.validity.valid ? 'valid' : 'invalid';
                $parent.find('.arrow-container').removeClass('valid invalid').addClass(status);
            }
        });
        
        var $submit = $('#contact-submit'),
            $form = $('#contact form'),
            $formElements = $form.find('input, textarea').not('[type=submit],[type=hidden]');
            
        $formElements.stickyholder();
        
        // make it so hitting enter while the submit div is focused submits the data
        $submit.keyup(function(evt) {
            // 13 == enter key
            if (evt.which === 13) {
                $form.submit();
            }
        });
        
        // Add click event to submit div
        $submit.click(function() {
            $form.submit();
        });
        
        $form.submit(Vestride.submitContact);
    },
    
    submitContact : function(event) {
        event.preventDefault();

        var $submit = $('#contact-submit'),
            $form = $('#contact form'),
            $formElements = $form.find('input, textarea').not('[type=submit]'),
            $notification = $form.find('.notification'),
            ok = true,
            errors = [],
            message = {},
            sendEnvelope = function() {
                $submit.addClass('closed');
                setTimeout(function() {
                    $submit.addClass('animate');
                }, 400);
            },
            retrieveEnvelope = function() {
                $submit.removeClass('animate');
                setTimeout(function() {
                    $submit.removeClass('closed');
                }, 600);
            };

        Vestride.hideContactErrors($notification);
        
        $formElements.each(function() {
            if ($(this).hasClass('holding')) {
                $(this).val('');
            }
            var type = this.type,
                name = this.name,
                nameUp = this.getAttribute('data-placeholder'),
                required = this.getAttribute('required') != null,
                value = this.value;

            nameUp = nameUp != null ? nameUp.replace('*', '') : ucFirst(name);

            // Check for html5 validity
            if ((this.validity) && !this.validity.valid) {
                this.focus();
                ok = false;

                if (this.validity.valueMissing) {
                    errors.push(nameUp + " must not be empty");
                }

                else if (this.validity.typeMismatch && type == 'email') {
                    errors.push(nameUp + " is invalid");
                }

                return;
            }

            // Check browser support for email type
            if (type == 'email' && !Modernizr.inputtypes.email && !Vestride.email_is_valid(value)) {
                this.focus();
                ok = false;
                errors.push(nameUp + " is invalid");
                return;
            }

            // Make sure all required inputs have a value
            if (required && !Modernizr.input.required && value == '') {
                this.focus();
                ok = false;
                errors.push(nameUp + ' is required');
                return;
            }

            if (name === 'name' && value !== "") {
                ok = false;
                errors.push("Are you sure you're not a bot? You should not have been able to change that field");
                return;
            }

            message[name] = value;
        });
        if (ok) {
            sendEnvelope();
            $.ajax({
                url : Vestride.themeUrl + "/ajax.php",
                dataType : 'json',
                data : 'method=sendContactMessage&data=' + JSON.stringify(message),
                success : function(response) {
                    if (response.success === true) {
                        Dialog.create({
                            title: 'Message sent! =]',
                            content: 'Your message has been sent successfully. We&rsquo;ll get back to you soon!',
                            classes: ['success'],
                            topPx: 135
                        });

                        // Clear the form is everything went ok
                        $form[0].reset();
                        $form.find('.arrow-container').removeClass('valid invalid');

                    } else if (Array.isArray(response)) {
                        Vestride.displayContactErrors(response, $notification);
                    } else {
                        Dialog.create({
                            title: 'Technical Difficulties',
                            content: 'Oops, something broke!',
                            classes: ['error'],
                            topPx: 135
                        });
                    }
                },
                error: function(response) {
                    Dialog.create({
                        title: 'Technical Difficulties',
                        content: 'Oops, something broke!',
                        classes: ['error'],
                        topPx: 135
                    });
                },
                complete : function() {
                    retrieveEnvelope();
                }
            });
            
        } else {
            // Show errors
            Vestride.displayContactErrors(errors, $notification);
        }
    },
    
    displayContactErrors : function(errors, $notification) {
        var html = '<h4>Sorry, we couldn\'t send your message.</h4><ul>',
            prop;
        for (prop in errors) {
            html += '<li>' + errors[prop] + '</li>';
        }
        html += '</ul>';
        $notification.html(html).attr('data-visible', 'true').show();
    },
    
    hideContactErrors : function($notification) {
        if ($notification.attr('data-visible') == "true") {
            $notification.attr('data-visible', 'false').hide();
        }
    },
    
    email_is_valid : function(email) {
        var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!emailRegEx.test(email)) {
            return false;
        }
        return true;
    },
    
    initScreenshots : function() {
        var $tiles = $('.project-sidebar .tiles li')
          , $container = $('.project-hero');
          
        $tiles.on('click', function() {
            var $tile = $(this)
              , isVideo = $tile.hasClass('is-video')
              , title = $tile.attr('title');
            
            $tiles.removeClass('active');
            $tile.addClass('active');
            $container.animate({opacity: 0}, 300, function() {
                if (isVideo) {
                    $container.html($tile.find('.embed').html());
                }
                else {
                    $container.html($('<img>', { 'src' : $tile.find('img').attr('data-promo'), alt : title, title: title}));
                }
                $container.animate({opacity: 1}, 300);
            });
        });
    }
};

$(document).ready(function() {
    if (!Vestride.onHomePage) {
        $('header .logo').addClass('visible');
    }
});