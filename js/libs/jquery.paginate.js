// IMPORTANT!
// If you're already using Modernizr, delete it from this file. If you don't know what Modernizr is, leave it :)

/* Modernizr 2.0.6 (Custom Build) | MIT & BSD
 * Build: http://www.modernizr.com/download/#-csstransforms-csstransforms3d-csstransitions-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes
 */
;window.Modernizr=function(a,b,c){function C(a,b){var c=a.charAt(0).toUpperCase()+a.substr(1),d=(a+" "+o.join(c+" ")+c).split(" ");return B(d,b)}function B(a,b){for(var d in a)if(k[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function A(a,b){return!!~(""+a).indexOf(b)}function z(a,b){return typeof a===b}function y(a,b){return x(n.join(a+";")+(b||""))}function x(a){k.cssText=a}var d="2.0.6",e={},f=!0,g=b.documentElement,h=b.head||b.getElementsByTagName("head")[0],i="modernizr",j=b.createElement(i),k=j.style,l,m=Object.prototype.toString,n=" -webkit- -moz- -o- -ms- -khtml- ".split(" "),o="Webkit Moz O ms Khtml".split(" "),p={},q={},r={},s=[],t=function(a,c,d,e){var f,h,j,k=b.createElement("div");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:i+(d+1),k.appendChild(j);f=["&shy;","<style>",a,"</style>"].join(""),k.id=i,k.innerHTML+=f,g.appendChild(k),h=c(k,a),k.parentNode.removeChild(k);return!!h},u,v={}.hasOwnProperty,w;!z(v,c)&&!z(v.call,c)?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],c)};var D=function(a,c){var d=a.join(""),f=c.length;t(d,function(a,c){var d=b.styleSheets[b.styleSheets.length-1],g=d.cssRules&&d.cssRules[0]?d.cssRules[0].cssText:d.cssText||"",h=a.childNodes,i={};while(f--)i[h[f].id]=h[f];e.csstransforms3d=i.csstransforms3d.offsetLeft===9},f,c)}([,["@media (",n.join("transform-3d),("),i,")","{#csstransforms3d{left:9px;position:absolute}}"].join("")],[,"csstransforms3d"]);p.csstransforms=function(){return!!B(["transformProperty","WebkitTransform","MozTransform","OTransform","msTransform"])},p.csstransforms3d=function(){var a=!!B(["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"]);a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d);return a},p.csstransitions=function(){return C("transitionProperty")};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));x(""),j=l=null,e._version=d,e._prefixes=n,e._domPrefixes=o,e.testProp=function(a){return B([a])},e.testAllProps=C,e.testStyles=t,g.className=g.className.replace(/\bno-js\b/,"")+(f?" js "+s.join(" "):"");return e}(this,this.document);

/**
 * Paginate by Glen Cheney
 * http://glencheney.com
 */
(function($) {
    var paginate = 'paginate',
        methods = {
        
        init : function(options) {
            var settings = {
                'item' : '.item',
                'itemWidth' : 230,
                'margins' : 20,
                'key' : 'all',
                'prevClass' : '.paginate-prev',
                'nextClass' : '.paginate-next',
                'controls' : '.paginate-controls'
            };
            
            if (options) {
                $.extend(settings, options);
            }
            
            return this.each(function() {
                var $this = $(this),
                    $items = $this.children(settings.item),
                    itemsPerRow = Math.floor($this.width() / settings.itemWidth),
                    numRows = 2,
                    itemHeight = $items.first().outerHeight(),
                    data;

                data = {
                    '$items' : $items,
                    'itemsPerRow' : itemsPerRow,
                    'numRows' : numRows,
                    'itemHeight' : itemHeight,
                    'itemWidth' : settings.itemWidth,
                    'margins' : settings.margins,
                    'prevClass' : settings.prevClass,
                    'nextClass' : settings.nextClass,
                    'controls' : settings.controls
                };

                $this.data(paginate, data);

                // Disabled CSS Animations if we're going to use jQuery to animate
                if (!Modernizr.csstransforms || !Modernizr.csstransitions) {
                    methods.setPrefixedCss($items, 'transition', 'none');
                }

                // Set up click events for next and previous
                methods.clicks.call(this, settings);
                
                // Do it
                methods.paginate.call(this, 'all');
            });
        },
        
        paginate : function(category) {
            var $this = $(this),
                data = $this.data(paginate);
            
            // If we somehow don't have data, initialize it
            if (!data) {
                methods.init.call(this);
                data = $(this).data(paginate);
            }
            
            if (!category) category = 'all';

            // Hide/show appropriate items
            if (category == 'all') {
                data.$items.removeClass('concealed stage-left stage-center stage-right');
            } else {
                data.$items.removeClass('concealed stage-left stage-center stage-right filtered').each(function() {
                    var keys = $(this).attr('data-key'),
                        kArray = $.parseJSON(keys);
                    if ($.inArray(category, kArray) === -1) {
                        $(this).addClass('concealed');
                        return;
                    }
                });
            }
            
            data.$items.not('.concealed').addClass('filtered');
                
            // Create the controls
            methods.createControls.call(this, $this.find('.filtered').length);

            // Shrink each concealed item
            methods.shrink.call(this);

            // Update transforms on .filtered elements so they will animate to their new positions
            methods.filter.call(this);
            methods.navigated.call($(this), 0);
        },
        
        clicks : function(settings) {
            var self = this;
            $(self).parent().find(settings.nextClass).click(function(){
                $(self).paginate('next');
            });
            $(self).parent().find(settings.prevClass).click(function(){
                $(self).paginate('prev');
            });
        },
        
        shrink : function() {
            var $concealed = $(this).find('.concealed');
            if ($concealed.length === 0) {
                return;
            }
            $concealed.each(function() {
                var $this = $(this),
                    x = parseInt($this.attr('data-x')),
                    y = parseInt($this.attr('data-y')),
                    data = $this.parent().data(paginate);

                if (!x) x = 0;
                if (!y) y = 0;

                methods.transition({
                    $this: $this,
                    x: x,
                    y: y,
                    left: (x + (data.itemWidth / 2)) + 'px',
                    top: (y + (data.itemHeight / 2)) + 'px',
                    scale : 0.001,
                    opacity: 0,
                    height: '0px',
                    width: '0px'
                });
            });
        },

        filter : function() {
            var $filtered = $(this).find('.filtered')
              , pages = Math.floor(($filtered.length - 1) / (data.itemsPerRow * data.numRows));
            
            console.log($(this));
            $(this).attr('data-pages', pages + 1);
            
            $filtered.each(function(index) {
                var $this = $(this),
                    data = $this.parent().data(paginate),
                    row = Math.floor(index / data.itemsPerRow),
                    x = (index % data.itemsPerRow) * (data.itemWidth + data.margins),
                    y = (row % data.numRows) * (data.itemHeight + data.margins),
                    page = Math.floor(index / (data.itemsPerRow * data.numRows));

                // Save data for shrink
                $this.attr({'data-x' : x, 'data-y' : y, 'data-page' : page});

                if (page === 0) {
                    $this.addClass('stage-center');
                }
                else if (page > 0) {
                    $this.addClass('stage-right');
                    x += $this.parent().width();
                }

                methods.transition({
                    $this: $this,
                    x: x,
                    y: y,
                    left: x + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: data.itemHeight + 'px',
                    width: data.itemWidth + 'px'
                });
            });
        },
        
        /**
         * Uses Modernizr's testAllProps (aka prefixed()) to get the correct
         * vendor property name and sets it using jQuery .css()
         * @param {jq} $el the jquery object to set the css on
         * @param {string} prop the property to set (e.g. 'transition')
         * @param {string} value the value of the prop
         */
        setPrefixedCss : function($el, prop, value) {
            $el.css(Modernizr.testAllProps(prop, 'pfx'), value);
        },
        
        transition: function(opts) {
            var transform;
            // Use CSS Transforms if we have them
            if (Modernizr.csstransforms && Modernizr.csstransitions) {
                if (Modernizr.csstransforms3d) {
                    transform = 'translate3d(' + opts.x + 'px, ' + opts.y + 'px, 0px) scale3d(' + opts.scale + ', ' + opts.scale + ', ' + opts.scale + ')';
                } else {
                    transform = 'translate(' + opts.x + 'px, ' + opts.y + 'px) scale(' + opts.scale + ', ' + opts.scale + ')';
                }

                // Update css to trigger CSS Animation
                methods.setPrefixedCss(opts.$this, 'transform', transform);
            } else {
                // Use jQuery to animate left/top
                opts.$this.animate({
                    left: opts.left,
                    top: opts.top,
                    opacity: opts.opacity,
                    height: opts.height,
                    width: opts.width
                }, 400);
            }
        },
        
        /**
         * Handles moving the current stage-center items to stage-left and 
         * moving the stage-right items with a data-page attr of +1 to stage center
         */
        next : function() {
            var data = this.data(paginate),
                $oldCenter = this.find('.filtered.stage-center'),
                currentPage = parseInt($oldCenter.first().attr('data-page')),
                nextPage = currentPage + 1,
                $newCenter = this.find('.filtered[data-page=' + nextPage + ']');
                
            // Make sure there's stuff to see
            if ($newCenter.length === 0) {
                return;
            }
                
            $oldCenter.addClass('stage-left').removeClass('stage-center');
            $newCenter.addClass('stage-center').removeClass('stage-right');
            
            // Transition the old stage-center items to stage-left
            $oldCenter.each(function(){
                var $this = $(this),
                    x = parseInt($this.attr('data-x')),
                    y = parseInt($this.attr('data-y')),
                    h = $this.height(),
                    w = $this.width(),
                    containerWidth = $this.parent().width();
                
                methods.transition({
                    $this: $(this),
                    x: x - containerWidth,
                    y: y,
                    left: x - containerWidth + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h + 'px',
                    width: w + 'px'
                });
            });
            
            // Transition the old stage-right items to stage-center
            $newCenter.each(function(index){
                var $this = $(this),
                    x = (index % data.itemsPerRow) * (data.itemWidth + data.margins),
                    y = parseInt($this.attr('data-y')),
                    h = $this.height(),
                    w = $this.width();
                
                methods.transition({
                    $this: $(this),
                    x: x,
                    y: y,
                    left: x + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h + 'px',
                    width: w + 'px'
                });
            });
            
            
            methods.navigated.call(this, nextPage);
        },
        
        /**
         * Handles moving the current stage-center items to stage-right and 
         * moving the stage-left items with a data-page attr of +1 to stage center
         */
        prev : function() {
            var data = this.data(paginate),
                $oldCenter = this.find('.filtered.stage-center'),
                currentPage = parseInt($oldCenter.first().attr('data-page')),
                nextPage = currentPage - 1,
                $newCenter = this.find('.filtered[data-page=' + nextPage + ']');
                
            // Make sure there's stuff to see
            if ($newCenter.length === 0) {
                return;
            }
            
            $oldCenter.addClass('stage-right').removeClass('stage-center');
            $newCenter.addClass('stage-center').removeClass('stage-left');
            
            // Transition the old stage-center items to stage-right
            $oldCenter.each(function(){
                var $this = $(this),
                    x = parseInt($this.attr('data-x')),
                    y = parseInt($this.attr('data-y')),
                    h = $this.height(),
                    w = $this.width(),
                    containerWidth = $this.parent().width();
                
                methods.transition({
                    $this: $(this),
                    x: x + containerWidth,
                    y: y,
                    left: x + containerWidth + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h + 'px',
                    width: w + 'px'
                });
            });
            
            // Transition the old stage-left items to stage-center
            $newCenter.each(function(index){
                var $this = $(this),
                    x = (index % data.itemsPerRow) * (data.itemWidth + data.margins),
                    y = parseInt($this.attr('data-y')),
                    h = $this.height(),
                    w = $this.width();
                
                methods.transition({
                    $this: $(this),
                    x: x,
                    y: y,
                    left: x + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h + 'px',
                    width: w + 'px'
                });
            });
            
            methods.navigated.call(this, nextPage);
        },
        
        /**
         * Puts the 'can-nav' class on the prev or next buttons where appropriate.
         * Puts the 'active' class on the correct control element
         * Shows the current page youre on and the total pages
         * 
         * @param {int} toIndex The zero based index of the page navigated to.
         */
        navigated : function(toIndex) {
            var data = this.data(paginate),
                hasStageLeft = this.find('.filtered[data-page=' + (toIndex - 1) + ']').length > 0,
                hasStageRight = this.find('.filtered[data-page=' + (toIndex + 1) + ']').length > 0;
            
            
            // Add classes to navigation buttons specifying if it can navigate
            if (hasStageLeft) {
                $(data.prevClass).addClass('can-nav');
            } else {
                $(data.prevClass).removeClass('can-nav');
            }
            if (hasStageRight) {
                $(data.nextClass).addClass('can-nav');
            } else {
                $(data.nextClass).removeClass('can-nav');
            }
            
            $(data.controls + ' span').each(function(index){
                if (toIndex != index) $(this).removeClass('active');
                else $(this).addClass('active');
            });
        },
        
        /**
         * Creates the span elements and places them in the control element
         * 
         * @param {int} total the total number of items. The function will figure out the number of pages.
         */
        createControls : function(total) {
            var $this = $(this),
                data = $this.data(paginate),
                $controls = $(data.controls),
                pages = Math.ceil(total / (data.itemsPerRow * data.numRows)),
                $ctrl,
                ctrlsWidth,
                html = '',
                i = 0;
                
            for (; i < pages; i++) {
                html += '<span data-index="' + i + '">' + (i + 1) + '</span>';
            }
            
            $controls.html(html);
            $ctrl = $controls.children().first();
            ctrlsWidth = (($ctrl.width() + parseInt($ctrl.css('marginRight'))) * pages) - parseInt($ctrl.css('marginRight'));
            $controls.css('width', ctrlsWidth);
        }
    };
    
    $.fn.paginate = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || ! method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' +  method + ' does not exist on jQuery.paginate');
            return false;
        }
    };
})(jQuery);