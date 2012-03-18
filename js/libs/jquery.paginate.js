// IMPORTANT!
// If you're already using Modernizr, delete it from this file. If you don't know what Modernizr is, leave it :)

/* Modernizr 2.5.3 (Custom Build) | MIT & BSD
 * Build: http://www.modernizr.com/download/#-csstransforms-csstransforms3d-csstransitions-cssclasses-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes
 */
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a)if(j[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.substr(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.5.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k=b.createElement("div"),l=b.body,m=l?l:b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),k.appendChild(j);return f=["&#173;","<style>",a,"</style>"].join(""),k.id=h,m.innerHTML+=f,m.appendChild(k),l||(m.style.background="",g.appendChild(m)),i=c(k,a),l?k.parentNode.removeChild(k):m.parentNode.removeChild(m),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e});var G=function(a,c){var d=a.join(""),f=c.length;w(d,function(a,c){var d=b.styleSheets[b.styleSheets.length-1],g=d?d.cssRules&&d.cssRules[0]?d.cssRules[0].cssText:d.cssText||"":"",h=a.childNodes,i={};while(f--)i[h[f].id]=h[f];e.csstransforms3d=(i.csstransforms3d&&i.csstransforms3d.offsetLeft)===9&&i.csstransforms3d.offsetHeight===3},f,c)}([,["@media (",m.join("transform-3d),("),h,")","{#csstransforms3d{left:9px;position:absolute;height:3px;}}"].join("")],[,"csstransforms3d"]);q.csstransforms=function(){return!!F("transform")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d),a},q.csstransitions=function(){return F("transition")};for(var H in q)y(q,H)&&(v=H.toLowerCase(),e[v]=q[H](),t.push((e[v]?"":"no-")+v));return z(""),i=k=null,e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,e.prefixed=function(a,b,c){return b?F(a,b,c):F(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document);

/**
 * Paginate by Glen Cheney
 * http://glencheney.com
 */
(function($) {
    var paginate = 'paginate',
        methods = {
        
        init : function(options) {
            var settings = {
                'itemSelector' : '.item',
                'itemWidth' : 230,
                'margins' : 20,
                'key' : 'all',
                'prevClass' : '.paginate-prev',
                'nextClass' : '.paginate-next',
                'pagesSelector' : '.paginate-container .pages',
                'controls' : '.paginate-controls'
            };
            
            if (options) {
                $.extend(settings, options);
            }
            
            return this.each(function() {
                var $this = $(this),
                    $items = $this.children(settings.itemSelector),
                    itemsPerRow = 3,
                    //itemsPerRow = Math.floor($this.width() / settings.itemWidth),
                    numRows = 2,
                    itemHeight = $items.first().outerHeight(),
                    data;

                data = {
                    'itemSelector' : settings.itemSelector,
                    'pagesSelector' : settings.pagesSelector,
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
                methods.clicks.call(this);
                
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
        
        clicks : function() {
            var $this = $(this)
              , data = $this.data(paginate);
            $this.parent().find(data.nextClass).click(function(){
                $this.paginate('next');
            });
            $this.parent().find(data.prevClass).click(function(){
                $this.paginate('prev');
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
            var $this = $(this)
              , $filtered = $(this).find('.filtered')
              , data = $this.data(paginate)
              , pages = Math.floor(($filtered.length - 1) / (data.itemsPerRow * data.numRows));
            
            $this.attr('data-pages', pages + 1);
            
            $filtered.each(function(index) {
                var $this = $(this),
                    //data = $this.parent().data(paginate),
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
         * Uses Modernizr's prefixed() to get the correct
         * vendor property name and sets it using jQuery .css()
         * @param {jq} $el the jquery object to set the css on
         * @param {string} prop the property to set (e.g. 'transition')
         * @param {string} value the value of the prop
         */
        setPrefixedCss : function($el, prop, value) {
            $el.css(Modernizr.prefixed(prop), value);
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
         * Gets the current page from the container (#grid), which is 1-based index
         */
        next : function() {
            methods.navigate.call(this, parseInt(this.attr('data-current-page')));
        },
        
        /**
         * Handles moving the current stage-center items to stage-right and 
         * moving the stage-left items with a data-page attr of +1 to stage center
         */
        prev : function() {
            methods.navigate.call(this, parseInt(this.attr('data-current-page')) - 2);
        },
        
        /**
         * @param {int} toIndex index to navigate to.
         */
        navigate : function(toIndex) {
            var data = this.data(paginate),
                $filtered = this.find('.filtered'),
                currentPage = parseInt($filtered.filter('.stage-center').first().attr('data-page')),
                $newCenter = $filtered.filter('[data-page=' + toIndex + ']'),
                $animating = $filtered.filter(function() {
                    var itemsPage = parseInt($(this).attr('data-page'));
                    if (toIndex > currentPage) {
                        return itemsPage < toIndex;
                    } else {
                        return itemsPage > toIndex;
                    }
                }),
                toStage = toIndex > currentPage ? 'stage-left' : 'stage-right',
                fromStage = toStage == 'stage-left' ? 'stage-right' : 'stage-left';
                
            // Make sure there's stuff to see
            if ($newCenter.length === 0) {
                return;
            }
            
            $animating.removeClass('stage-center ' + fromStage).addClass(toStage);
            $newCenter.addClass('stage-center').removeClass(fromStage);
            
            // Transition the old stage-center items to stage-left/right
            $animating.each(function(){
                var $this = $(this),
                    containerWidth = $this.parent().width(),
                    x = toIndex > currentPage ? parseInt($this.attr('data-x')) - containerWidth : parseInt($this.attr('data-x')) + containerWidth,
                    y = parseInt($this.attr('data-y')),
                    h = $this.height() + 'px',
                    w = $this.width() + 'px';
                
                
                methods.transition({
                    $this: $(this),
                    x: x,
                    y: y,
                    left: x + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h,
                    width: w
                });
            });
            
            // Transition the old stage-right items to stage-center
            $newCenter.each(function(index){
                var $this = $(this),
                    x = (index % data.itemsPerRow) * (data.itemWidth + data.margins),
                    y = parseInt($this.attr('data-y')),
                    h = $this.height() + 'px',
                    w = $this.width() + 'px';
                
                methods.transition({
                    $this: $(this),
                    x: x,
                    y: y,
                    left: x + 'px',
                    top: y + 'px',
                    scale : 1,
                    opacity: 1,
                    height: h,
                    width: w
                });
            });
            
            
            methods.navigated.call(this, toIndex);
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
            
            // add Page 1/2
            this.attr('data-current-page', toIndex + 1);
            $(data.pagesSelector).text('Page ' + this.attr('data-current-page') + '/' + this.attr('data-pages'));
            
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
            
            $(data.controls).children().each(function() {
                var $control = $(this);
                $control.on('click', function(){
                    $this.paginate('navigate', parseInt($control.attr('data-index')));
                });
            });
            
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