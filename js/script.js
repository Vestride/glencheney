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
        settings.$mask = $('<div/>', {"class" : settings.maskClass}).css({
            'background' : settings.maskBackground
        });

        // Close the dialog when mask is clicked on if not modal
        if (!defaults.modal) {
            settings.$mask.click(function(e) {
                settings.closeFunction(e);
            });
        }

        // Container
        settings.$container = $('<div/>', {"class" : settings.containerClass}).css({
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
        settings.$header = $('<div/>', {"class" : 'es-dialog-header'});
        settings.$h3 = $('<h3/>').text(defaults.title);
        settings.$header.append(settings.$h3);


        // Close Link
        settings.$x = $('<a/>', {
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
        if (typeof fn === 'function') {
            this.callbacks.push = fn;
        }
    },

    centerVertically : function() {
        var container = this.getContainer().get(0);
        container.style.height = '';
        container.style.height = container.offsetHeight + 'px';
        container.style.marginTop = (parseInt(container.style.height, 10) / 2) * -1 + 'px';
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

    Modules: {},

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

    titles : {
        'home' : 'Home',
        'about' : 'About',
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
                Vestride.setNavTitle(id);
            } else {
                $(navId).removeClass('in');
            }
        });

        Vestride.Modules.Backdrop.update();
    },
    
    initMobileNav : function() {
        var $body = $('body')
          , $navInside = $('#nav .nav-inside')
          , $navButton = $('#nav .sidebar-nav-button');
          
        $navButton.on('click', function(evt) {
            $navInside.addClass('on-screen');
            evt.stopPropagation(); // Stop bubbling
            $body.on('click', function() {
                $navInside.removeClass('on-screen');
                $body.off('click');
            });
        });
        
        if (this.onHomePage) {
            $('#nav .nav-title').text(Vestride.titles['home']);
        }
    },
    
    setNavTitle : function(id) {
        if (Modernizr.mq('only screen and (max-width: 600px)')) {
            $('#nav .nav-title').text(Vestride.titles[id]);
        }
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
            $grid.shuffle($this.data('group'));
        });

        $('#grid').shuffle({
            easing: 'ease-out',
            speed: 800,
            group : 'all'
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

            if (name === 'name' && value !== '') {
                ok = false;
                errors.push('Are you sure you\'re not a bot? You should not have been able to change that field');
                return;
            }

            message[name] = value;
        });
        if (ok) {
            sendEnvelope();
            $.ajax({
                url : Vestride.themeUrl + '/ajax.php',
                dataType : 'json',
                data : 'method=sendContactMessage&data=' + JSON.stringify(message),
                success : function(response) {
                    if (response.success === true) {
                        Dialog.create({
                            title: 'Message sent! =]',
                            content: 'Your message has been sent successfully. I&rsquo;ll get back to you soon!',
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
        var html = '<h4>Sorry, I couldn\'t send your message.</h4><ul>',
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
        var $projectCarousel = $('.js-project-carousel')
          , $cycle = $projectCarousel.cycle({
            timeout:  0,
            speed:  400,
            center: true,
            width: 980,
            fx : 'scrollHorz',
            activePagerClass : 'js-current activeSlide',
            pager: '.carousel-control',
            next: '.js-carousel-next',
            prev: '.js-carousel-prev',
            before : function(currSlideElement, nextSlideElement, options, forwardFlag) {
                var $container = $('.js-project-carousel-container')
                  , $curr = $(currSlideElement)
                  , $next = $(nextSlideElement)
                  , anim = function() {
                        $curr.animate({
                            opacity: 0
                        }, 300).removeClass('js-current');
                    };
                
                if ($curr.height() != $next.height()) {
                    // Pause the slide in until the animation is done
                    $projectCarousel.cycle('pause'); // This doesn't pause the animation... ugh
                    $container.animate({
                        height: $next.height()
                    }, 200, function() {
                        anim();
                        $projectCarousel.cycle('resume');
                    });
                } 
                
                else {
                    anim();
                }
            },
            after : function(currSlideElement, nextSlideElement, options, forwardFlag) {
                $(nextSlideElement).animate({
                    opacity: 1
                }, 400).addClass('js-current');
            },
            pagerAnchorBuilder : function(index, el) {
                Vestride.cycleNoLinks(this, index, el);
            },
            updateActivePagerLink : function(pager, index, active) {
                $(pager).children().removeClass(active).eq(index).addClass(active);
            }
        });
        
        // Fades out the view images button and fades in the image navigation
        $('.js-project-hero, .js-view-images').on('click', function() {
            Vestride.showScreenshots();
        });
        
        // Add click to image to make it go to the next in carousel
        $('.js-project-carousel').on('click', '.js-current', function() {
            $cycle.cycle('next');
        });
        
        $('.carousel-control span').on('click', function() {
            var zeroBasedIndex = parseInt($(this).text()) - 1;
            $cycle.cycle(zeroBasedIndex);
        });
        
        // Fades out the image navigation on click and fades in the view screenshots button
        $('.js-close-slideshow').on('click', function() {
            Vestride.hideScreenshots();
        });
        
        // Hide carousel at start
        $('.js-project-carousel, .js-slideshow-nav').hide();
    },
    
    showScreenshots : function() {
        var $hero = $('.js-project-hero')
          , $viewImages = $('.js-view-images-container')
          , $nav = $('.js-slideshow-nav')
          , $carousel = $('.js-project-carousel')
          , $container = $('.js-project-carousel-container');
          
        // Save height so we can use it again
        Vestride.containerHeight = $container.height();
        
        // Fade out hero and view images button
        $hero.add($viewImages).fadeOut(function() {
            // Animate the height of the container
            $container.animate({
                height: $carousel.find('.js-current img').height()
            }, 400, function() {
                // Fade in the image gallery
                $carousel.add($nav).fadeIn();
            });
        });
    },
    
    hideScreenshots : function() {
        var $hero = $('.js-project-hero')
          , $viewImages = $('.js-view-images-container')
          , $nav = $('.js-slideshow-nav')
          , $carousel = $('.js-project-carousel')
          , $container = $('.js-project-carousel-container');
        
        // Fade out carousel and nav buttons
        $carousel.add($nav).fadeOut(function() {
            // Animate the height of the container
            $container.animate({
                height: Vestride.containerHeight
            }, 400, function() {
                // Fade in the hero image
                $hero.add($viewImages).fadeIn();
            });
        });
    }
};

Vestride.Modules.Backdrop = (function($, window) {
    var fullHeight = null,
        minHeight = null,
        availableToScroll = null,
        friction = 0.3,
        $backdrop = null,
        $city = null,
        $cityCompact = null,
        $sunburst = null,
        $navLogo = null,
        centered = 0,
        left = -180,

    initBackdrop = function() {
        $backdrop = $('.backdrop');
        $city = $backdrop.find('.city');
        $cityCompact = $backdrop.find('.city-compact');
        $sunburst = $backdrop.find('.sunburst');
        $navLogo = $('nav .logo');
        fullHeight = $backdrop.height();
        minHeight = $city.height() + 10;
        availableToScroll = fullHeight - minHeight;
    },

    modifyBackdrop = function() {
        var scrolled = $(window).scrollTop(),
            newHeight = fullHeight - (scrolled * friction),
            amountScrolledWithFriction,
            leftToScroll,
            percentScrolled,
            backdropX,
            compactOpacity;


        if (newHeight < minHeight) {
            newHeight = minHeight;
            $backdrop.addClass('minimized');
            $navLogo.addClass('visible');
        } else {
            $backdrop.removeClass('minimized');
            $navLogo.removeClass('visible');
        }

        leftToScroll = newHeight - minHeight;
        amountScrolledWithFriction = availableToScroll - leftToScroll;
        percentScrolled = compactOpacity = amountScrolledWithFriction / availableToScroll;

        // Constrain the opacity of the compact city to .3 opacity;
        if (compactOpacity > 0.7) compactOpacity = 0.7;
        $cityCompact.css('opacity', 1 - compactOpacity);
        $city.css('opacity', percentScrolled);

        backdropX = centered + Math.round(percentScrolled * left);

        if (backdropX < left) newHeight = left;

        // Move the text at the same speed as regular scrolling
        $backdrop.children().first().css('bottom', scrolled);

        // Move the city over
        $sunburst.css('background-position', backdropX + 'px 0');

        // Move Backdrop at half speed
        $backdrop.css('height', newHeight);
    };

    return {
        init: initBackdrop,
        update: modifyBackdrop
    };
}(jQuery, window));

$(document).ready(function() {
    if (Vestride.onHomePage) {
        // Smooth scrolling
        Vestride.initLocalScroll();
        $.localScroll.hash({
            duration: 600
        });
        
        // Parallax city scape
        Vestride.Modules.Backdrop.init();

        // Check to see if sections are in the viewport on scroll
        $(window).scroll(function() {
            Vestride.scrolledIt();
        });
        
        // Set up 'Featured' carousel
        Vestride.initCycle('cycleWithLinks', '.carousel');
        
        // Add work filter functionality
        Vestride.initWorkFiltering();
        
        // Set up ajax form
        Vestride.initContactSubmit();
    } else {
        $('header .logo').addClass('visible');

    }
    Vestride.initMobileNav();
});